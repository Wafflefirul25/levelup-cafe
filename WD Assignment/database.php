<?php
//Database Configuration
$host = 'localhost';
$db_name = 'levelup_db';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password empty

try {
    //PDO Connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    
    //Error mode to exception to catch database errors easily
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Default fetch mode to associative array, making working data easier
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Database connected successfully.";

} catch (PDOException $e){
    //If connection fails, shows clean error message
    die("Database connection failed: " . $e->getMessage());
}
?>