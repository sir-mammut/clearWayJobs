<?php
date_default_timezone_set('Africa/Nigeria');

require 'constants/db_config.php';

$myEmail = $_POST['email'];
$myPass = md5($_POST['password']);

    try {
	
       $stmt = $conn->prepare("SELECT * FROM users   
                               WHERE email = :myemail 
                               AND password = :mypassword");
   	$stmt->bindParam(':myemail', $myEmail);
   	$stmt->bindParam(':mypassword', $myPass);

      $stmt->execute();
      $result = $stmt->fetchAll();

	   $rec = count($result);
	
     	if ($rec == "0") {
	         header("location:../login.php?r=0346");
   	}else{

    foreach($result as $row)
    {
	$role = $row['role'];
	if ($role == "employee") {
   	   session_start();
       $_SESSION['logged'] = true;
       $_SESSION['myid'] = $row['member_no'];
       $_SESSION['myfname'] = $row['first_name'];
	    $_SESSION['mylname'] = $row['last_name'];
       $_SESSION['myemail'] = $row['email'];
	    $_SESSION['mydate'] = $row['bdate'];
	    $_SESSION['mymonth'] = $row['bmonth'];
	    $_SESSION['myyear'] = $row['byear'];
       $_SESSION['myphone'] = $row['phone'];
	    $_SESSION['myedu'] = $row['education'];
	    $_SESSION['mytitle'] = $row['title'];
	    $_SESSION['mycity'] = $row['city'];
	    $_SESSION['mystreet'] = $row['street'];
	    $_SESSION['myzip'] = $row['zip'];
       $_SESSION['mycountry'] = $row['country'];
       $_SESSION['mydesc'] = $row['about'];


	    $_SESSION['avatar'] = $row['avatar'];
	    $_SESSION['lastlogin'] = $row['last_login'];
	    $_SESSION['avatar'] = $row['avatar'];
	    $_SESSION['gender'] = $row['avatar'];
	    $_SESSION['role'] = $role;


	
	}else{
    	session_start();
        $_SESSION['logged'] = true;	
    	  $_SESSION['myid'] = $row['member_no'];
        $_SESSION['compname'] = $row['first_name'];
    	  $_SESSION['established'] = $row['byear'];
        $_SESSION['myemail'] = $row['email'];
        $_SESSION['myphone'] = $row['phone'];
    	$_SESSION['comptype'] = $row['title'];
    	$_SESSION['mycity'] = $row['city'];
    	$_SESSION['mystreet'] = $row['street'];
	    $_SESSION['myzip'] = $row['zip'];
        $_SESSION['mycountry'] = $row['country'];
        $_SESSION['mydesc'] = $row['about'];
     	$_SESSION['avatar'] = $row['avatar'];
    	$_SESSION['myserv'] = $row['services'];
     	$_SESSION['myexp'] = $row['expertise'];
    	$_SESSION['lastlogin'] = $row['last_login'];
    	$_SESSION['website'] = $row['website'];
    	$_SESSION['people'] = $row['people'];
    	$_SESSION['role'] = $role;

	}
	
    try {
    if(isset($_SESSION['logged'])){
	$day = date('D');
$nowT = date('g:ia');
$nowD = date('d-M-Y');
$now = $day." at ".$nowT." on ".$nowD;

    $stmt = $conn->prepare("UPDATE clearway_db.users SET last_login = :lastlogin WHERE email= :email");
	$stmt->bindParam(':lastlogin', $now);
    $stmt->bindParam(':email', $myEmail);
    $stmt->execute();
	header("location:../$role");
   }
					  
	}catch(PDOException $e)
    {

    }
	

	}
	
	}
					  
	}catch(PDOException $e)
    {

    }

?>
