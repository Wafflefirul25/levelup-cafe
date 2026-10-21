<?php
// Shared PHP helpers. SQL failures never become fake availability.
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params(['httponly'=>true,'samesite'=>'Lax','secure'=>!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off']);
    session_start();
}
date_default_timezone_set('Asia/Brunei');
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function db() {
    static $pdo;
    $localPath = __DIR__.'/config.local.php';
    $local = is_file($localPath) ? require $localPath : [];
    if (!is_array($local)) throw new RuntimeException('Local database configuration must return an array.');
    if (!$pdo) $pdo = new PDO('mysql:host='.($local['host'] ?? (getenv('DB_HOST') ?: 'localhost')).';dbname='.($local['database'] ?? (getenv('DB_NAME') ?: 'levelup_db')).';charset=utf8mb4', $local['username'] ?? (getenv('DB_USER') ?: 'root'), $local['password'] ?? (getenv('DB_PASS') ?: ''), [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=>false]);
    return $pdo;
}
function csrf() { if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function check_csrf() { if (!is_string($_POST['csrf'] ?? null) || !hash_equals(csrf(), $_POST['csrf'])) { http_response_code(403); exit('Invalid form token. Reload the page.'); } }
function require_admin() { if (empty($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; } }
function seats() { return db()->query('SELECT id, label, category, hourly_rate, active FROM seats WHERE active = 1 ORDER BY id')->fetchAll(); }
