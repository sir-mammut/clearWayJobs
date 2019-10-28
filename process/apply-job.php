<?php
require '../process/constants/settings.php';
date_default_timezone_set($default_timezone);
$apply_date = date('m/d/Y');

session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
$myid = $_SESSION['myid'];	
$myrole = $_SESSION['role'];
$opt = $_GET['opt'];

if ($myrole == "employee"){
include '../process/constants/db_config.php';

    try {
    
    $stmt = $conn->prepare("SELECT * FROM job_applications WHERE member_no = '$myid' AND job_id = :jobid");
	$stmt->bindParam(':jobid', $opt);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $rec = count($result);
	
	if ($rec == 0) {
	
    try {
	
    $stmt = $conn->prepare("INSERT INTO job_applications (member_no, job_id, application_date)
    VALUES (:memberno, :jobid, :appdate)");
    $stmt->bindParam(':memberno', $myid);
    $stmt->bindParam(':jobid', $opt);
    $stmt->bindParam(':appdate', $apply_date);
    $stmt->execute();
	
	print '<br>
	 <div class="alert alert-success">
     You have successfully applied this job.
	 </div>
     ';
					  
	}catch(PDOException $e)
    {
        echo $e->getMessage();
    }
	
		
	}else{
	foreach($result as $row)
    {
	 print '<br>
	 <div class="alert alert-warning">
     You have already applied this job before , you can not apply again.
	 </div>
     ';
	}	
		
	}


					  
	}catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	
}}

?>
