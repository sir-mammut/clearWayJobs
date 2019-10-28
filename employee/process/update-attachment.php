<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$title = ucwords($_POST['title']);
$issuer = ucwords($_POST['issuer']);
$certificate = addslashes(file_get_contents($_FILES['certificate']['tmp_name']));
$certid = $_POST['attid'];

if ($certificate == "") {
	
try {

$stmt = $conn->prepare("UPDATE other_attachments SET title = :title, issuer = :issuer WHERE id=:certid AND member_no = '$myid'");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':issuer', $issuer);
$stmt->bindParam(':certid', $certid);
$stmt->execute();
header("location:../attachments.php?r=7764");					  
}catch(PDOException $e)
{

}
	
}else{
	
if ($_FILES["certificate"]["size"] > 1000000) {
header("location:../attachments.php?r=2290");
}else{
try {
$stmt = $conn->prepare("UPDATE other_attachments SET title = :title, issuer = :issuer, attachment = '$certificate' WHERE id=:certid AND member_no = '$myid'");
$stmt->bindParam(':title', $title);
$stmt->bindParam(':issuer', $issuer);
$stmt->bindParam(':certid', $certid);
$stmt->execute();
header("location:../attachments.php?r=7764");					  
}catch(PDOException $e)
{

}

}
	
}

?>
