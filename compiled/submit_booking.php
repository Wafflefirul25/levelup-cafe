<?php
require 'includes/bootstrap.php';
if ($_SERVER['REQUEST_METHOD']!=='POST') { header('Location: booking.php'); exit; }
check_csrf();
try {
 $name=trim(is_string($_POST['name']??null)?$_POST['name']:'');
 $email=trim(is_string($_POST['email']??null)?$_POST['email']:'');
 $seat=filter_input(INPUT_POST,'seat_id',FILTER_VALIDATE_INT);
 $hours=filter_input(INPUT_POST,'hours',FILTER_VALIDATE_INT);
 $date=is_string($_POST['date']??null)?$_POST['date']:'';
 $time=is_string($_POST['start']??null)?$_POST['start']:'';
 $start=DateTimeImmutable::createFromFormat('!Y-m-d H:i',$date.' '.$time);
 if($name==='' || strlen($name)>100 || strlen($email)>190 || !filter_var($email,FILTER_VALIDATE_EMAIL) || !$seat || !$hours || $hours<1 || $hours>4 || !preg_match('/^(1[0-9]|2[01]):00$/',$time) || !$start || $start->format('Y-m-d H:i')!==$date.' '.$time || $start<=new DateTimeImmutable() || $date>date('Y-m-d',strtotime('+90 days'))) throw new InvalidArgumentException('Please provide valid customer details and a future date within 90 days.');
 $end=$start->modify('+'.$hours.' hours');
 if($end->format('H:i')>'22:00' || $end->format('Y-m-d')!==$date) throw new InvalidArgumentException('Sessions must finish by 22:00.');
 $pdo=db(); $pdo->beginTransaction();
 // Serialize writers for this seat before checking interval overlap.
 $q=$pdo->prepare('SELECT hourly_rate FROM seats WHERE id=? AND active=1 FOR UPDATE');$q->execute([$seat]);$row=$q->fetch();
 if(!$row) throw new InvalidArgumentException('This seat is unavailable.');
 $q=$pdo->prepare("SELECT id FROM bookings WHERE seat_id=? AND status='confirmed' AND start_at < ? AND end_at > ? FOR UPDATE");$q->execute([$seat,$end->format('Y-m-d H:i:s'),$start->format('Y-m-d H:i:s')]);
 if($q->fetch()) throw new InvalidArgumentException('This seat is already reserved during that interval. Choose another seat or time.');
 $q=$pdo->prepare('INSERT INTO customers(name,email) VALUES(?,?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)');$q->execute([$name,$email]);$customer=(int)$pdo->lastInsertId();
 $total=round((float)$row['hourly_rate']*$hours,2);
 $q=$pdo->prepare('INSERT INTO bookings(customer_id,seat_id,start_at,end_at,total) VALUES(?,?,?,?,?)');$q->execute([$customer,$seat,$start->format('Y-m-d H:i:s'),$end->format('Y-m-d H:i:s'),$total]);
 $id=$pdo->lastInsertId();$pdo->commit();
 $_SESSION['booking_success']='Booking LU-'.$id.' confirmed. Seat #'.$seat.', '.$start->format('d M Y H:i').'–'.$end->format('H:i').'. Total B$'.number_format($total,2).'. Keep this reference.';
} catch(InvalidArgumentException $ex) { if(isset($pdo)&&$pdo->inTransaction())$pdo->rollBack();$_SESSION['booking_error']=$ex->getMessage();
} catch(PDOException $ex) {if(isset($pdo)&&$pdo->inTransaction())$pdo->rollBack();error_log($ex->getMessage());$_SESSION['booking_error']='Booking could not be saved. Please try again later.';}
header('Location: booking.php');exit;
