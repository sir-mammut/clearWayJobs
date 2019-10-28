<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$exp_id = $_GET['id'];

try {

$stmt = $conn->prepare("DELETE FROM experience WHERE id=:expid AND member_no = '$myid'");
$stmt->bindParam(':expid', $exp_id);
$stmt->execute();
header("location:../experience.php?r=0593");				  
}catch(PDOException $e)
{

}
?>

