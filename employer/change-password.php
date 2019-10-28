<?php 
$title = "Change Password";

include 'include/head.php';
include '../process/constants/settings.php'; 
include 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}
?>


<body class="not-transparent-header">

	<div class="container-wrapper">
    <?php
     include("include/employerHeader.php");
    ?>



	<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Home</a></li>
                 <li><a href="./"><?php echo "$compname"; ?></a></li>
						<li><span>Change Password</span></li>
					</ol>
					
				</div>
				
			</div>

			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">
						
							<div class="GridLex-col-3_sm-4_xs-12">
							
								<div class="admin-sidebar">
										
										
									<div class="admin-user-item for-employer">
										
										<div class="image">
										<?php 
										if ($logo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										}
										?><br>
										</div>
										
										<h4><?php echo "$compname"; ?></h4>
										
									</div>
									
									<div class="admin-user-action text-center">
								
										<a href="post-job.php" class="btn btn-primary btn-sm btn-inverse">Post a Job</a>
										
									</div>
									
									<ul class="admin-user-menu clearfix">
										<li  class="">
											<a href="./"><i class="fa fa-user"></i> Profile</a>
										</li>
										<li class="active">
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
										</li>
			
										<li>
											<a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Company Overview</a>
										</li>
										<li>
											<a href="my-jobs.php"><i class="fa fa-bookmark"></i> Posted Jobs</a>
										</li>
										<li>
											<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
										</li>
									</ul>
									
								</div>

							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Change Password</h2>
										
									</div>

									<form name="frm" class="post-form-wrapper" action="process/new-pass.php" method="POST">
								
											<div class="row gap-20">
                                             <?php include 'constants/check_reply.php'; ?>
												

												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>New Password</label>
														<input type="password" class="form-control" name="password" required placeholder="Enter your new password">
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Confirm Password</label>
														<input type="password" class="form-control"  name="confirmpassword" required placeholder="Confirm your new password">
													</div>
													
												</div>
												
												<div class="col-sm-12 mt-10">
													<button type="submit" onclick="return check_passwords();" class="btn btn-primary">Update</button>
													<button type="reset" class="btn btn-primary btn-inverse">Cancel</a>
												</div>

											</div>
											
										</form><br>
										
									
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
