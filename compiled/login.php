<?php
require 'includes/bootstrap.php'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST') {
 check_csrf();
 if(time()<($_SESSION['retry_after']??0)) $error='Please wait one minute before trying again.';
 else try {
 $username=is_string($_POST['username']??null)?trim($_POST['username']):'';
 $password=is_string($_POST['password']??null)?$_POST['password']:'';
 $q=db()->prepare('SELECT id,username,password_hash FROM admins WHERE username=?');$q->execute([$username]);$admin=$q->fetch();
 if($admin && password_verify($password,$admin['password_hash'])) {session_regenerate_id(true);$_SESSION['admin_logged_in']=true;$_SESSION['admin_username']=$admin['username'];$_SESSION['attempts']=0;$_SESSION['csrf']=bin2hex(random_bytes(32));header('Location: admin_dashboard.php');exit;}
 $error='Invalid username or password.';$_SESSION['attempts']=($_SESSION['attempts']??0)+1;if($_SESSION['attempts']>=5){$_SESSION['retry_after']=time()+60;$_SESSION['attempts']=0;}
 } catch(PDOException $ex){error_log($ex->getMessage());$error='Login is unavailable. Check database setup.';}
}
$title='Administrator login';require 'includes/header.php'; ?>
<h1>Administrator login</h1><?php if($error): ?><p class="notice" role="alert"><?= e($error) ?></p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf()) ?>"><label for="username">Username</label><input id="username" name="username" maxlength="100" autocomplete="username" required><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required><p><button>Login</button></p></form><?php require 'includes/footer.php'; ?>
