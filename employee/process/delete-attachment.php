<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$attid = $_GET['id'];

try {

$stmt = $conn->prepare("DELETE FROM other_attachments WHERE id=:certid AND member_no = '$myid'");
$stmt->bindParam(':certid', $attid);
$stmt->execute();
header("location:../attachments.php?r=6784");					  
}catch(PDOException $e)
{

}
	
?>
