<?php
// CLI only: run from compiled/database. Credentials stay out of the repository.
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
require __DIR__.'/../includes/bootstrap.php';
$username=trim(getenv('LEVELUP_ADMIN_USER')?:'');$password=getenv('LEVELUP_ADMIN_PASSWORD')?:'';
if($username===''||strlen($username)>100||strlen($password)<12){fwrite(STDERR,"Set LEVELUP_ADMIN_USER and LEVELUP_ADMIN_PASSWORD (at least 12 characters).\n");exit(1);}
try{$q=db()->prepare('INSERT INTO admins(username,password_hash) VALUES(?,?)');$q->execute([$username,password_hash($password,PASSWORD_DEFAULT)]);echo "Administrator created.\n";}catch(PDOException $ex){error_log($ex->getMessage());fwrite(STDERR,"Could not create administrator. Check database setup and duplicate username.\n");exit(1);}
