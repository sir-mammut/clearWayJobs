<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$ref_id = $_GET['id'];

try {

	
$stmt = $conn->prepare("DELETE FROM referees WHERE id=:refid AND member_no = '$myid'");
$stmt->bindParam(':refid', $ref_id);
$stmt->execute();
   header("location:../referees.php?r=9517");					  
}catch(PDOException $e)
{
    echo  $e->getMessage();
}

?>

