<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$cert_id = $_GET['id'];

try {

$stmt = $conn->prepare("DELETE FROM academic_qualification WHERE id=:certid AND member_no = '$myid'");
$stmt->bindParam(':certid', $cert_id);
$stmt->execute();
header("location:../academic.php?r=1521");					  
}catch(PDOException $e)
{

}

?>
