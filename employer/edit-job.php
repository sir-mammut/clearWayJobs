<?php

require '../process/constants/settings.php'; 
require 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}

if (isset($_GET['jobid'])) {
require '../process/constants/db_config.php'; 
$jobid = $_GET['jobid'];


try {
	
$stmt = $conn->prepare("SELECT * FROM jobs WHERE job_id = :jobid AND company = '$myid'");
$stmt->bindParam(':jobid', $jobid);
$stmt->execute();
$result = $stmt->fetchAll();
$rec = count($result);

if ($rec == "0") {
	header("location:./");
}else{
	
foreach($result as $row)
{
    $jobtitle = $row['title'];
	$jobcity = $row['city'];
	$jobcountry = $row['country'];
	$jobcategory = $row['category'];
	$jobtype = $row['type'];
	$experience = $row['experience'];
	$jobdescription = $row['description'];
	$jobrespo = $row['responsibility'];
	$jobreq = $row['requirements'];
	$closingdate = $row['closing_date'];		
}

}
					  
}catch(PDOException $e)
 {

 }
}

$title = "$jobtitle"; 
include'include/head.php';
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
						<li><span><?php echo "$jobtitle"; ?></span></li>
					</ol>
					
				</div>
				
			</div>


			
			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-sm-5 col-md-4">
							
								<div class="company-detail-sidebar">
									
									<div class="image">
										<?php 
										if ($logo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										}
										?>
									</div>
									
									<h2 class="heading mb-15"><h4><?php echo "$compname"; ?></h4>
								
									<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$zip"; ?> <?php echo "$street"; ?>, <?php echo "$city"; ?>. <?php echo "$country"; ?> <span class="block"> <i class="fa fa-phone"></i> <?php echo "$myphone"; ?></span></p>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Established In:</h4>
											<?php echo "$esta"; ?>
										</li>
										<li>
											<h4 class="heading">Type:</h4>
											<?php echo "$mytitle"; ?>
										</li>
										<li>
											<h4 class="heading">People:</h4>
											<?php echo "$mypeople"; ?>
										</li>
										<li>
											<h4 class="heading">Website: </h4>
											<a target="_blank" href="https://<?php echo "$myweb"; ?>"><?php echo "$myweb"; ?></a>
										</li>
										<li>
											<h4 class="heading">Email: </h4>
											<?php echo "$mymail"; ?>
										</li>

									</ul>
									
									<a href="./" class="btn btn-primary mt-5"><i class="fa fa-pencil-square-o mr-5"></i>Edit</a>
									
								</div>
					
					
							</div>
							
							<div class="col-sm-7 col-md-8">
							
								<div class="company-detail-wrapper">

									<div class="company-detail-company-overview  mt-0 clearfix">
										
										<div class="section-title-02">
											<h3 class="text-left"><?php echo "$jobtitle"; ?></h3>
										</div>

										<form class="post-form-wrapper" action="process/update-job.php" method="POST" autocomplete="off">
								
											<div class="row gap-20">
											<?php include 'constants/check_reply.php'; ?>
										
												<div class="col-sm-8 col-md-8">
												
													<div class="form-group">
														<label>Job Title</label>
														<input name="title" value="<?php echo "$jobtitle"; ?>" required type="text" class="form-control" placeholder="Enter job title">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>City</label>
														<input name="city" value="<?php echo "$jobcity"; ?>"  required type="text" class="form-control" placeholder="Enter city">
													</div>
													
												</div>
												
												<div class="col-sm-4 col-md-4">
												
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
		                                                    ?> <option <?php if ($jobcountry == $row['country_name']) { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
													</div>
													
												</div>
												
												<div class="clear"></div>


												<div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Job Category</label>
															<select name="category" required class="selectpicker show-tick form-control" data-live-search="true">
															<option disabled value="">Select</option>
						                                   <?php
														   require '../process/constants/db_config.php';
														   try {
                                                           $stmt = $conn->prepare("SELECT * FROM categories ORDER BY category");
                                                           $stmt->execute();
                                                           $result = $stmt->fetchAll();
  
                                                           foreach($result as $row)
                                                           {
		                                                    ?> <option <?php if ($jobcategory == $row['category']) { print ' selected '; } ?> value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option> <?php
	 
	                                                        }

					  
	                                                       }catch(PDOException $e)
                                                           {

                                                           }
	
														   ?>
														</select>
																							
													</div>
													
												</div>

											    <div class="col-sm-4 col-md-4">
												
													<div class="form-group">
														<label>Closing Date</label>
														<input name="deadline" required type="text" class="form-control" value="<?php echo "$closingdate"; ?>" placeholder="Eg: 30/12/2018">
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Job Type:</label>
														<select name="jobtype" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected>Select</option>
															<option <?php if ($jobtype == "Full-time") { print ' selected '; } ?> value="Full-time" data-content="<span class='label label-warning'>Full-time</span>">Full-time</option>
															<option <?php if ($jobtype == "Part-time") { print ' selected '; } ?> value="Part-time" data-content="<span class='label label-danger'>Part-time</span>">Part-time</option>
															<option <?php if ($jobtype == "Freelance") { print ' selected '; } ?> value="Freelance" data-content="<span class='label label-success'>Freelance</span>">Freelance</option>
														</select>
													</div>
													
												</div>
												
												<div class="col-xss-12 col-xs-6 col-sm-6 col-md-4">
												
													<div class="form-group mb-20">
														<label>Experience:</label>
														<select name="experience" required class="selectpicker show-tick form-control" data-live-search="false" data-selected-text-format="count > 3" data-done-button="true" data-done-button-text="OK" data-none-selected-text="All">
															<option value="" selected >Select</option>

															<option <?php if ($experience == "Expert") { print ' selected '; } ?> value="Expert">Expert</option>
															<option <?php if ($experience == "2 Years") { print ' selected '; } ?> value="2 Years">2 Years</option>
															<option <?php if ($experience == "3 Years") { print ' selected '; } ?> value="3 Years">3 Years</option>
															<option <?php if ($experience == "4 Years") { print ' selected '; } ?> value="4 Years">4 Years</option>
															<option <?php if ($experience == "5 Years") { print ' selected '; } ?> value="5 Years">5 Years</option>
														</select>
													</div>
													
													
												</div>

												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Description</label>
														<textarea class="form-control bootstrap3-wysihtml5" name="description" required placeholder="Enter description ..." style="height: 200px;"><?php echo "$jobdescription"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												


												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Job Responsibilies</label>
														<textarea name="responsiblities" required class="form-control bootstrap3-wysihtml5" placeholder="Enter responsiblities..." style="height: 200px;"><?php echo "$jobrespo"; ?></textarea>
													</div>
													
												</div>
												
												<div class="clear"></div>
												
												<div class="col-sm-12 col-md-12">
												
													<div class="form-group bootstrap3-wysihtml5-wrapper">
														<label>Requirements</label>
														<textarea name="requirements" required class="form-control bootstrap3-wysihtml5" placeholder="Enter requirements..." style="height: 200px;"><?php echo "$jobreq"; ?></textarea>
													</div>
													<input type="hidden" name="jobid" value="<?php echo "$jobid"; ?>">
												</div>
												
												<div class="clear"></div>
												

												
												<div class="clear"></div>
												

												
												<div class="clear mb-10"></div>

												
												<div class="clear mb-15"></div>

												
												<div class="clear"></div>
												
												<div class="col-sm-6 mt-30">
													<button type="submit"  class="btn btn-primary btn-lg">Save Changes</button>
												</div>

											</div>
											
										</form>
										
									</div>
									
							


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
