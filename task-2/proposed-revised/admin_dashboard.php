<?php
require 'includes/bootstrap.php';
require_admin();
$message = $_SESSION['admin_message'] ?? '';
unset($_SESSION['admin_message']);
$rows = [];
$report = [];
$dataAvailable = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    try {
        $pdo = db();
        $action = is_string($_POST['action'] ?? null) ? $_POST['action'] : '';
        if ($action === 'cancel' || $action === 'delete') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if (!$id || $id < 1) throw new InvalidArgumentException('Choose a valid booking.');
            if ($action === 'cancel') {
                $q = $pdo->prepare("UPDATE bookings SET status='cancelled' WHERE id=? AND status='confirmed'");
                $q->execute([$id]);
                $message = $q->rowCount() === 1 ? 'Booking cancelled.' : 'No change: booking was already cancelled or no longer exists.';
            } else {
                $q = $pdo->prepare('DELETE FROM bookings WHERE id=?');
                $q->execute([$id]);
                $message = $q->rowCount() === 1 ? 'Booking deleted.' : 'No change: booking no longer exists.';
            }
        } elseif ($action === 'seat') {
            $label = is_string($_POST['label'] ?? null) ? trim($_POST['label']) : '';
            $category = is_string($_POST['category'] ?? null) ? $_POST['category'] : '';
            $rawRate = is_string($_POST['rate'] ?? null) ? trim($_POST['rate']) : '';
            // Match the DECIMAL(7,2) database column without silently rounding input.
            if ($label === '' || strlen($label) > 50 || !in_array($category, ['Standard', 'Premium'], true)
                || !preg_match('/^\d{1,5}(?:\.\d{1,2})?$/D', $rawRate) || (float)$rawRate <= 0) {
                throw new InvalidArgumentException('Enter a seat label, valid category and positive rate with at most two decimal places.');
            }
            $q = $pdo->prepare('INSERT INTO seats(label,category,hourly_rate) VALUES(?,?,?)');
            $q->execute([$label, $category, $rawRate]);
            $message = 'Seat created.';
        } else {
            throw new InvalidArgumentException('Unknown action.');
        }
    } catch (InvalidArgumentException $ex) {
        $message = $ex->getMessage();
    } catch (PDOException $ex) {
        error_log($ex->getMessage());
        $message = $ex->getCode() === '23000' ? 'This record conflicts with existing data. Use a unique seat label.' : 'Database action failed. Please try again later.';
    }
    // Redirect after both successful and rejected actions; refresh cannot repeat a POST.
    $_SESSION['admin_message'] = $message;
    header('Location: admin_dashboard.php');
    exit;
}
try {
    $pdo = db();
    $rows = $pdo->query('SELECT b.*,c.name,c.email,s.label FROM bookings b JOIN customers c ON c.id=b.customer_id JOIN seats s ON s.id=b.seat_id ORDER BY b.start_at DESC')->fetchAll();
    $report = $pdo->query("SELECT DATE(start_at) AS booking_date,COUNT(*) AS sessions,SUM(total) AS booked_value FROM bookings WHERE status='confirmed' GROUP BY DATE(start_at) ORDER BY booking_date DESC")->fetchAll();
    $dataAvailable = true;
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    $message = trim($message.' Booking records and reports are temporarily unavailable.');
}
$title='Administrator dashboard';require 'includes/header.php'; ?>
<h1>Session control</h1><p>Signed in as <?= e($_SESSION['admin_username']) ?>. <a href="admin_dashboard.php#report">View daily report</a></p>
<form action="logout.php" method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><button>Logout</button></form>
<?php if($message): ?><p class="notice" role="status"><?= e($message) ?></p><?php endif; ?>
<h2>Create a seat</h2><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="action" value="seat"><label for="label">Seat label</label><input id="label" name="label" maxlength="50" required><label for="type">Category</label><select id="type" name="category"><option>Standard</option><option>Premium</option></select><label for="rate">Hourly rate (B$)</label><input id="rate" name="rate" type="number" min="0.01" max="99999.99" step="0.01" required><p><button>Create seat</button></p></form>
<h2>Bookings</h2><p>Administrators can also create bookings through <a href="booking.php">Book a session</a>. Cancellation updates the booking status. Delete permanently removes a booking.</p><div class="table-wrap"><table><thead><tr><th>Reference</th><th>Customer</th><th>Seat / time</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead><tbody><?php foreach($rows as $b): ?><tr><td>LU-<?= (int)$b['id'] ?></td><td><?= e($b['name']) ?><br><?= e($b['email']) ?></td><td><?= e($b['label']) ?><br><?= e($b['start_at']) ?><br>to <?= e($b['end_at']) ?></td><td>B$<?= e($b['total']) ?></td><td><?= e($b['status']) ?></td><td><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= (int)$b['id'] ?>"><?php if($b['status']==='confirmed'): ?><button name="action" value="cancel">Cancel</button><?php endif; ?><button class="danger" name="action" value="delete">Delete</button></form></td></tr><?php endforeach; ?></tbody></table><?php if($dataAvailable && !$rows): ?><p>No booking records to display.</p><?php endif; ?></div>
<section id="report"><h2>Daily booking report</h2><p>Confirmed bookings grouped by session start date. Booked value is reserved session value, not payment received. Cancelled bookings are excluded.</p><div class="table-wrap"><table><thead><tr><th>Date</th><th>Sessions</th><th>Booked value (B$)</th></tr></thead><tbody><?php foreach($report as $r): ?><tr><td><?= e($r['booking_date']) ?></td><td><?= (int)$r['sessions'] ?></td><td><?= e($r['booked_value']) ?></td></tr><?php endforeach; ?></tbody></table><?php if($dataAvailable && !$report): ?><p>No confirmed bookings.</p><?php endif; ?></div></section><?php require 'includes/footer.php'; ?>
