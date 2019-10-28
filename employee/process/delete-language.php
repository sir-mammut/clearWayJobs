<?php
require '../../process/constants/db_config.php';
require '../constants/check-login.php';
$lang_id = $_GET['id'];

try {
	
$stmt = $conn->prepare("DELETE FROM language WHERE id=:langid AND member_no = '$myid'");
$stmt->bindParam(':langid', $lang_id);
$stmt->execute();
header("location:../language.php?r=0591");				  
}catch(PDOException $e)
{

}

?>

