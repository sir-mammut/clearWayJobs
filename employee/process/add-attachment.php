<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$title = ucwords($_POST['title']);
$issuer = ucwords($_POST['issuer']);
$certificate = addslashes(file_get_contents($_FILES['certificate']['tmp_name']));

if ($_FILES["certificate"]["size"] > 1000000) {
header("location:../attachments.php?r=2290");
}else{
	
try {

$stmt = $conn->prepare("INSERT INTO other_attachments (member_no, title, issuer, attachment) VALUES ('$myid', :title, :issuer, '$certificate')");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':issuer', $issuer);
$stmt->execute();
header("location:../attachments.php?r=6789");				  
}catch(PDOException $e)
{

}

	
}

?>
