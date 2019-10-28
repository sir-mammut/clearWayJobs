<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$job_id = $_GET['id'];

try {
	
$stmt = $conn->prepare("DELETE FROM jobs WHERE job_id= :jobid AND company = '$myid'");
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM job_application WHERE job_id= :jobid");
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();

      header("location:../my-jobs.php?r=0173");					  
}catch(PDOException $e)
{
      $e->getMessage();
}
	
?>
