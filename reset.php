
<?php 
$title = "Reset Password";
include'include/generalHeader.php';
require 'process/constants/settings.php'; 
require 'process/constants/check-login.php';

if (isset($_GET['token'])) {
$token = $_GET['token'];	
}else{
	header("location:./");
}

?>

<body class="not-transparent-header">

<?php
include'include/notTrHeader.php';
?>


		<div class="main-wrapper">


			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list">
						<li><a href="./">Home</a></li>
						<li><span>Reset Password</span></li>
					</ol>
					
				</div>
				
			</div>


			<div class="login-container-wrapper">	
	
				<div class="container">
				
					<div class="row">
					
						<div class="col-md-10 col-md-offset-1">
						
							<div class="row">

								<div class="col-sm-6 col-sm-offset-3">
                                <?php
								require 'constants/check_reply.php';	
								?>
                                <form name="frm" action="process/change-pass.php" method="POST" autocomplete="off">
                                <div class="login-box-wrapper">
							
                                <div class="modal-header">
                                <h4 class="modal-title text-center">Reset your password</h4>
                                </div>

                                <div class="modal-body">
																
                                <div class="row gap-20">
								<?php
								require 'process/constants/db_config.php';
								
								try {
                          	
                                $stmt = $conn->prepare("SELECT * FROM tokens WHERE token = :token limit 1");
								$stmt->bindParam(':token', $token);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                $res = count($result);
								
								if ($res == "0") {
									                                  print '
	                            <div class="alert alert-warning">
								<strong>Could not use this token because</strong><br>
                                 <li>This token is invalid</li>
								 <li>This token is already used</li>
	                          </div>
                                  ';
								 $invalid_token = true;
								 
								}else{

                                foreach($result as $row)
                                {
									?>
							    <div class="col-sm-12 col-md-12">

                                <div class="form-group"> 
                                <label>New password</label>
                                <input class="form-control" placeholder=" 8  to 20 characters" name="password" required type="password"> 
                                </div>
												
                                 </div>
												
                                <div class="col-sm-12 col-md-12">
												
                                <div class="form-group"> 
                                <label>Confirm New Password</label>
                                <input class="form-control" placeholder="8 to 20 characters" name="confirmpassword" required type="password"> 
                                </div>
												
                                </div>
								<?php
								$_SESSION['resetmail'] = $row['email'];
								?>
								<?php
								
 
	                            }
								}

					  
	                            }catch(PDOException $e)
                                {
           
                                }
	
	
                                ?>

								
</div>

</div>
<?php
if (isset($invalid_token)) {
	
}else{
print '
<div class="modal-footer text-center">
<button type="submit" onclick="return val();"  class="btn btn-primary">Reset my password</button>
</div>';	
}

?>

										
</div>
</form>
									
								</div>
							
							</div>
							
						</div>
						
					</div>
					
				</div>
			
			</div>







<!-- Footer -->

<?php
include("include/generalFooter.php");
?>

<!-- End of Footer -->
