<?php
require '../constants/db_config.php';
require '../constants/check-login.php';
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

if ($_FILES["image"]["size"] > 1000000) {
header("location:../?r=3478");
}else{
	
    try {
	
    $stmt = $conn->prepare("UPDATE users SET avatar='$image' WHERE member_no='$myid'");
    $stmt->execute();
	
	$stmt = $conn->prepare("SELECT * FROM users WHERE member_no='$myid'");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row)
    {
     $_SESSION['avatar'] = $row['avatar'];
	 
	 header("location:../?r=2222");
	}
					  
	}catch(PDOException $e)
    {

    }

	
}

?>
