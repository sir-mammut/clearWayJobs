<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$train_id = $_GET['id'];

try {
	
$stmt = $conn->prepare("DELETE FROM training WHERE id=:trainid AND member_no = '$myid'");
$stmt->bindParam(':trainid', $train_id);
$stmt->execute();
header("location:../training.php?r=9522");					  
}catch(PDOException $e)
{

}

?>

