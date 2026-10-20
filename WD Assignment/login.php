<?php
//Start session, browser remembers admin logged in
session_start();

//Include secure database connection file
require_once 'database.php';

//Start blank error variable to display to user if login fails
$error_message = "";

//Check if user clicked "login" button (ubmitted the form)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Grab username and password from form input fields
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    //Security: Use PDO prepred statement to prevent SQL Injection
    //The ':' placeholders act as safe zones for data
    $query = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($query);

    //Bind the user input safely and execute the query
    $stmt->execute([':username' => $input_username]);
    $admin = $stmt->fetch();

    //Check if the admin user exists and the password matches perfectly
    if ($admin && $input_password === $admin['password']){
        //Save the admin session data
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];

        //Redirect the admin straight to the secret dashboard page
        header("Location: admin_dashboard.php");
        exit;
    }else{
        //Fallback error message if credentials does not match
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    <title>Level Up Cafe Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #121212; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;}
        .login-box { background-color: #1e1e1e; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); width: 300px; text-align: center; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #333; background: #2b2b2b; color: white; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #ff4757; border: none; color: white; font-weight: bold; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #e84118; }
        .error { color: #ff4757; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🎮 Level Up Admin</h2>
    
    <!-- If there is an error message, display it right here -->
    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- The login form that sends data back to this same file using POST -->
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>