
<?php
include '../process/constants/settings.php'; 
include 'constants/check-login.php';


if ($user_online == "true") {
   if ($myrole == "employer") {
        //do nothing stay at employer index page
   }else{
     header("location:../");		
   }
}else{
header("location:../");	
}

$title = " Company Profile";
include("include/head.php");
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
						<li><span><?php echo $compname."'s Profile"; ?></span></li>
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
										<li  class="active">
											<a href="./"><i class="fa fa-user"></i> Profile</a>
										</li>
										<li class="">
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
									
										<h2><?php echo $compname."'s Profile"; ?></h2>
										<p>Your last loged-in: <span class="text-primary"><?php echo "$mylogin"; ?></span></p>
										
									</div>
<?php include '../process/constants/check_reply.php'; ?>
									<form class="post-form-wrapper" action="process/update-profile.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-8">
												
													<div class="form-group">
														<label>Company Name</label>
														<input name="company" placeholder="Enter company name" type="text" class="form-control" value="<?php echo "$compname"; ?>" required>
													</div>
													
												</div>
												<div class="clear"></div>

												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Established In</label>
                                                    <input name="year" placeholder="Enter year eg: 2016, 2017, 2018" type="text" class="form-control" value="<?php echo "$esta"; ?>" required>
													</div>
													
												</div>
												
                             		<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Type</label>
                                                    <input class="form-control" placeholder="Eg: Booking, Travel" name="type" required type="text" value="<?php echo "$mytitle"; ?>" required> 
													</div>
													
												</div>

                                	<div class="clear"></div>

												<div class="form-group">
													
													<div class="col-sm-6 col-md-4">
														<label>People</label>


														<select name="people" required class="selectpicker show-tick form-control mb-15" data-live-search="false">
															<option <?php if ($mypeople == "1-10") { print ' selected '; } ?> value="1-10">1-10</option>
															<option <?php if ($mypeople == "11-100") { print ' selected '; } ?> value="11-100">11-100</option>
															<option <?php if ($mypeople == "200+") { print ' selected '; } ?> value="200+" >200+</option>
															<option <?php if ($mypeople == "300+") { print ' selected '; } ?> value="300+">300+</option>
															<option <?php if ($mypeople == "1000+") { print ' selected '; } ?>value="1000+">1000+ </option>
														</select>
													</div>

													<div class="col-sm-6 col-md-4">
														<label>Website</label>
														<input type="text" class="form-control" value="<?php echo "$myweb"; ?>" name="web" placeholder="Enter your website">
													</div>
														
												</div>
												
												<div class="clear"></div>
								
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>City/town</label>
														<input name="city" required type="text" class="form-control" value="<?php echo "$city"; ?>" placeholder="Enter your city">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Street</label>
														<input name="street" required type="text" class="form-control" value="<?php echo "$street"; ?>" placeholder="Enter your street">
													</div>
													
												</div>
												
												<div class="clear"></div>
																				
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Zip Code</label>
														<input name="zip" required type="text" class="form-control" value="<?php echo "$zip"; ?>" placeholder="Enter your zip">
													</div>
													
												</div>
												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Country</label>
														<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Select</option>


						                                   <?php
														   require '../process/constants/db_config.php';
														   try {
                                               $stmt = $conn->prepare("SELECT * FROM countries ORDER BY country_name");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($country == $row['country_name']) { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
													</div>
													
												</div>

												<div class="clear"></div>


												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" name="phone" required class="form-control" value="<?php echo "$myphone"; ?>" placeholder="Enter your phone">
													</div>
													
												</div>
												

												
												<div class="col-sm-6 col-md-4">
												
													<div class="form-group">
														<label>Email Address</label>
														<input type="email" name="email" required class="form-control" value="<?php echo "$mymail"; ?>" placeholder="Enter your email">
													</div>
													
												</div>
												



												<div class="clear"></div>
												


												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Company background</label>
														<textarea name="background" class="bootstrap3-wysihtml5 form-control" placeholder="Enter company background ..." style="height: 200px;"><?php echo "$desc"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

	
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Services</label>
														<textarea name="services" class="bootstrap3-wysihtml5 form-control" placeholder="Enter company services ..." style="height: 200px;"><?php echo "$myserv"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

	
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Expertise</label>
														<textarea name="expertise" class="bootstrap3-wysihtml5 form-control" placeholder="Enter company expertise ..." style="height: 200px;"><?php echo "$myex"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<button type="submit" class="btn btn-primary">Save</button>
													<button type="reset" class="btn btn-warning">Cancel</button>
												</div>

											</div>
											
										</form><br>

										<form action="process/new-pic.php" method="POST" enctype="multipart/form-data">
										<div class="row gap-20">
										<div class="col-sm-12 col-md-12">
												
										<div class="form-group bootstrap3-wysihtml5-wrapper">
										<label>Company Logo</label>
										<input accept="image/*" type="file" name="image"  required >
										</div>
													
										</div>


										<div class="clear"></div>

										<div class="col-sm-12 mt-10">
										<button type="submit" class="btn btn-primary">Update</button>
										<?php 
										if ($logo == null) {

										}else{
										?><a onclick = "return confirm('Are you sure you want to delete your current profile picture ?')" class="btn btn-primary btn-inverse" href="../process/drop-dp.php">Delete</a> <?php
										}
										?>
										</div>
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
