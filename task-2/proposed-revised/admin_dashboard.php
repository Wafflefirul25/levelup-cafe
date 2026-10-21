<?php
require 'includes/bootstrap.php';require_admin();$message='';$rows=[];$seats=[];$report=[];
try{
 $pdo=db();
 if($_SERVER['REQUEST_METHOD']==='POST'){
 check_csrf();$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);$action=$_POST['action']??'';
 if($action==='cancel'){$q=$pdo->prepare("UPDATE bookings SET status='cancelled' WHERE id=?");$q->execute([$id]);$message='Booking cancelled.';}
 elseif($action==='delete'){$q=$pdo->prepare('DELETE FROM bookings WHERE id=?');$q->execute([$id]);$message='Booking deleted.';}
 elseif($action==='seat'){
 $label=trim(is_string($_POST['label']??null)?$_POST['label']:'');$category=$_POST['category']??'';$rate=filter_input(INPUT_POST,'rate',FILTER_VALIDATE_FLOAT);
 if($label===''||strlen($label)>50||!in_array($category,['Standard','Premium'],true)||$rate===false||$rate===null||$rate<=0||$rate>99999.99)throw new InvalidArgumentException('Enter a valid seat label, category and positive rate.');
 $q=$pdo->prepare('INSERT INTO seats(label,category,hourly_rate) VALUES(?,?,?)');$q->execute([$label,$category,$rate]);$message='Seat created.';
 }else throw new InvalidArgumentException('Unknown action.');
 $_SESSION['admin_message']=$message;header('Location: admin_dashboard.php');exit;
 }
 $rows=$pdo->query('SELECT b.*,c.name,c.email,s.label FROM bookings b JOIN customers c ON c.id=b.customer_id JOIN seats s ON s.id=b.seat_id ORDER BY b.start_at DESC')->fetchAll();
 $report=$pdo->query("SELECT DATE(start_at) AS booking_date,COUNT(*) AS sessions,SUM(total) AS booked_value FROM bookings WHERE status='confirmed' GROUP BY DATE(start_at) ORDER BY booking_date DESC")->fetchAll();
}catch(InvalidArgumentException $ex){$message=$ex->getMessage();}catch(PDOException $ex){error_log($ex->getMessage());$message='Database action failed. Check setup or duplicate seat labels.';}
$title='Administrator dashboard';require 'includes/header.php'; ?>
<h1>Session control</h1><p>Signed in as <?= e($_SESSION['admin_username']) ?>. <a href="admin_dashboard.php#report">View daily report</a></p>
<form action="logout.php" method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><button>Logout</button></form>
<?php $message=$_SESSION['admin_message']??$message;unset($_SESSION['admin_message']);if($message): ?><p class="notice" role="status"><?= e($message) ?></p><?php endif; ?>
<h2>Create a seat</h2><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="action" value="seat"><label for="label">Seat label</label><input id="label" name="label" maxlength="50" required><label for="type">Category</label><select id="type" name="category"><option>Standard</option><option>Premium</option></select><label for="rate">Hourly rate (B$)</label><input id="rate" name="rate" type="number" min="0.01" max="99999.99" step="0.01" required><p><button>Create seat</button></p></form>
<h2>Bookings</h2><p>Administrators can also create bookings through <a href="booking.php">Book a session</a>. Cancellation updates the booking status. Delete permanently removes a booking.</p><div class="table-wrap"><table><thead><tr><th>Reference</th><th>Customer</th><th>Seat / time</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead><tbody><?php foreach($rows as $b): ?><tr><td>LU-<?= (int)$b['id'] ?></td><td><?= e($b['name']) ?><br><?= e($b['email']) ?></td><td><?= e($b['label']) ?><br><?= e($b['start_at']) ?><br>to <?= e($b['end_at']) ?></td><td>B$<?= e($b['total']) ?></td><td><?= e($b['status']) ?></td><td><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><input type="hidden" name="id" value="<?= (int)$b['id'] ?>"><?php if($b['status']==='confirmed'): ?><button name="action" value="cancel">Cancel</button><?php endif; ?><button class="danger" name="action" value="delete">Delete</button></form></td></tr><?php endforeach; ?></tbody></table><?php if(!$rows): ?><p>No booking records to display.</p><?php endif; ?></div>
<section id="report"><h2>Daily booking report</h2><p>Confirmed bookings grouped by session start date. Booked value is reserved session value, not payment received. Cancelled bookings are excluded.</p><div class="table-wrap"><table><thead><tr><th>Date</th><th>Sessions</th><th>Booked value (B$)</th></tr></thead><tbody><?php foreach($report as $r): ?><tr><td><?= e($r['booking_date']) ?></td><td><?= (int)$r['sessions'] ?></td><td><?= e($r['booked_value']) ?></td></tr><?php endforeach; ?></tbody></table><?php if(!$report): ?><p>No confirmed bookings.</p><?php endif; ?></div></section><?php require 'includes/footer.php'; ?>
