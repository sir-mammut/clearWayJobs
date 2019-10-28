<?php
require 'db_config.php';
if (isset($_GET['r'])) {
       $error_code = $_GET['r'];

    try {

    $stmt = $conn->prepare("SELECT * FROM alerts WHERE code = :errorcode");

	$stmt->bindParam(':errorcode', $error_code);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row)
    {
		
     $description = $row['description'];
     $type = $row['type'];
     print '<center>
	 <div class="alert alert-'.$type.'">
     '.$description.'
	 </div>
    </center>
     ';
	}

					  
	}catch(PDOException $e)
    {

    }
	

}

?>
