<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ClearWay Jobs | View Certificate</title>
<link rel="shortcut icon" href="images/ico/favicon.png">
<link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
<?php
require 'process/constants/db_config.php';
$file_id = $_GET['id'];

try {
	
$stmt = $conn->prepare("SELECT * FROM professional_qualification WHERE id = :fileid");
$stmt->bindParam(':fileid', $file_id);
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row)
{
    $certificate = $row['certificate'];
	$course = $row['title'];
	
	?>
<iframe  style="border:none;" src="assets/ViewerJS/?title=<?php echo "$course"; ?>#<?php echo 'data:application/pdf;base64,'.base64_encode($certificate).'' ?>" height="100%" width="100%"></iframe>

<?php
}

					  
}catch(PDOException $e)
{
   echo $e->getMessage();
}

?>

</body>

</html>

