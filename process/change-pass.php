<?php
session_start();
$usermail = $_SESSION['resetmail'];
$new_password = md5($_POST['password']);

require '../process/constants/db_config.php';

    try {
	
    $stmt = $conn->prepare("UPDATE users SET login = :newlogin WHERE email= :email");
	$stmt->bindParam(':newlogin', $new_password);
    $stmt->bindParam(':email', $usermail);
    $stmt->execute();
	
	$stmt = $conn->prepare("DELETE FROM tokens WHERE email = :email");
    $stmt->bindParam(':email', $usermail);
    $stmt->execute();
	$_SESSION['resetmail'] = "";
	header("location:../login.php?r=3091");
					  
	}catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	

?>

