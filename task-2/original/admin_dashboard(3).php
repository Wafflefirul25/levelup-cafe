<?php//STart session to read login data
session_start();

//Security check: If admin is not logged in, kick them out to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Level Up Cafe - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #121212; color: white; margin: 0; padding: 20px; }
        .navbar { display: flex; justify-content: space-between; align-items: center; background-color: #1e1e1e; padding: 10px 20px; border-radius: 8px; }
        .logo { font-size: 20px; font-weight: bold; color: #ff4757; }
        .logout-btn { background-color: #ff4757; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .logout-btn:hover { background-color: #e84118; }
        .container { margin-top: 30px; }
        .welcome-card { background-color: #1e1e1e; padding: 20px; border-radius: 8px; border-left: 5px solid #ff4757; }
    </style>
</head>
<body>

    <!-- Simple Dashboard Navbar -->
    <div class="navbar">
        <div class="logo">🎮 Level Up Admin Dashboard</div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content Area -->
    <div class="container">
        <div class="welcome-card">
            <h2>Welcome back! 👋</h2>
            <p>You have securely bypassed the login screen. This area is completely restricted from regular cafe customers.</p>
        </div>
    </div>

</body>
</html>
