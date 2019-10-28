<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';

$new_password = md5($_POST['password']);

    try {
    

    $stmt = $conn->prepare("UPDATE users SET password = :newpassword WHERE member_no='$myid'");
    $stmt->bindParam(':newpassword', $new_password);
    $stmt->execute();
	header("location:../change-password.php?r=9564");	  
	}catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
