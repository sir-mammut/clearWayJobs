<?php
$title = "Academic Qualifications";
include'include/head.php';
require '../process/constants/settings.php'; 
require 'constants/check-login.php';

if ($user_online == "true") {
if ($myrole == "employee") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*5)-5;
}					
}else{
$page1 = 0;
$page = 1;	
}
?>


<body class="not-transparent-header">

	<div class="container-wrapper">
   

<?php
     include 'include/employeeHeader.php';
   ?>


		<div class="main-wrapper">

			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="../">Home</a></li>
         			<li><a href="./">Profile</a></li>
						<li><span>Academic Qualifications</span></li>
					</ol>
					
				</div>
				
			</div>
		
			

			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">
						
							<div class="GridLex-col-3_sm-4_xs-12">
							
								<div class="admin-sidebar">
										
									<div class="admin-user-item">
									<div class="image">	
									
										<?php 
										if ($myavatar == null) {
										print '<center><img class="img-circle autofit2" src="../images/default.jpg" title="'.$myfname.'" alt="image"  /></center>';
										}else{
										echo '<center><img class="img-circle autofit2" alt="image" title="'.$myfname.'"  src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										}
										?>
										</div>
										<br>
										
										
										<h4><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></h4>
										<p class="user-role"><?php echo "$mytitle"; ?></p>
										
									</div>
									
									<div class="admin-user-action text-center">
									
										<a target="_blank" href="my_cv" class="btn btn-primary btn-sm btn-inverse">View my CV</a>
										
									</div>
									
									<ul class="admin-user-menu clearfix">
										<li>
											<a href="./"><i class="fa fa-user"></i> Profile</a>
										</li>
										<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
										</li>
										<li  >
											<a href="qualifications.php"><i class="fa fa-trophy"></i> Professional Qualifications</a>
										</li>
										<li>
											<a href="language.php"><i class="fa fa-language"></i> Language Proficiency</a>
										</li>
										<li>
											<a href="training.php"><i class="fa fa-gears"></i> Training & Workshop</a>
										</li>
										<li>
											<a href="referees.php"><i class="fa fa-users"></i> Referees</a>
										</li>
										<li class="active">
											<a href="academic.php"><i class="fa fa-graduation-cap"></i> Academic Qualifications</a>
										</li>
										<li>
											<a href="experience.php"><i class="fa fa-briefcase"></i> Working Experience</a>
										</li>
										<li>
											<a href="attachments.php"><i class="fa fa-folder-open"></i> Other Attachments</a>
										</li>
										<li>
											<a href="applied-jobs.php"><i class="fa fa-bookmark"></i> Applied Jobs</a>
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
									
										<h2>Academic Qualifications</h2>
					
										
									</div>
									
									<div class="resume-list-wrapper">
									<?php require 'constants/check_reply.php'; ?>
									<?php
									require '../process/constants/db_config.php';
									
									try {
                                  
                                    $stmt = $conn->prepare("SELECT * FROM academic_qualification WHERE member_no = '$myid' ORDER BY id LIMIT $page1,5");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row)
                                    {
									 $ccountry = $row['country'];
									 $institution = $row['institution'];
									 $course = $row['course'];
									 $timeframe = $row['timeframe'];
									 $course_id = $row['id'];
									 $level = $row['level'];
									 
									 ?>
									 									<div class="resume-list-item">
										
											<div class="row">
											
												<div class="col-sm-12 col-md-10">
												
													<div class="content">
													
														<a  target="_blank" href="view-certificate-c.php?id=<?php echo $row['id']; ?>" >

															<div class="image">
															<?php 
										                    if ($myavatar == null) {
									                    	print '<center><img src="../images/default.jpg" title="'.$myfname.'" alt="image" width="100" height="100" /></center>';
										                    }else{
										                    echo '<center><img alt="image" title="'.$myfname.'" width="100" height="100" src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										                    }
										                      ?>
															</div>
															
															<h4><?php echo $row['course']; ?></h4>
															
															<div class="row">
																<div class="col-sm-12 col-md-9">
																	<i class="fa fa-graduation-cap text-primary mr-5"></i><strong class="mr-10"><?php echo $row['institution']; ?></strong> <i class="fa fa-map-marker text-primary mr-5"></i> <?php echo $row['country']; ?>.
																</div>
																<div class="col-sm-12 col-md-3 mt-10-sm">
																	<i class="fa fa-calendar  text-primary mr-5"></i> <?php echo $row['timeframe']; ?>
																</div>
															</div>

														</a>
													
													</div>
												
												</div>


				
												<div class="col-sm-12 col-md-2">
													
													<div class="resume-list-btn">
													
														<a data-toggle="modal" href="#edit<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-5 mb-0-sm">Edit</a>
									<a href="process/delete-academic.php?id=<?php echo $row['id']; ?>" onclick = "return confirm('Are you sure you want to delete this qualification ?')" class="btn btn-primary btn-sm btn-inverse">Delete</a>
									<div id="edit<?php echo $row['id']; ?>" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				                    <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                 <h4 class="modal-title text-center"><?php echo "$course"; ?></h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="process/update-academic-qualification.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">
									<div class="col-sm-12 col-md-12">
												
									<div class="form-group">
									<label>Education Level</label>
									<select name="level" required class="selectpicker show-tick form-control" data-live-search="false">
									<option disabled value="">Select</option>
									<option <?php if ($level == "Certificate") { print ' selected '; } ?> value="Certificate">Certificate</option>
                                    <option <?php if ($level == "O Level (WAEC,NECO...etc)") { print ' selected '; } ?>  value="O Level (WAEC,NECO...etc)">O Level (WAEC,NECO...etc)</option>
                                    <option <?php if ($level == "NCE") { print ' selected '; } ?>  value="NCE">NCE</option>
                                    <option <?php if ($level == "Diploma (OND)") { print ' selected '; } ?>  value="Diploma (OND)">Diploma (OND)</option>
                                    <option <?php if ($level == "Advance Diploma (HND)") { print ' selected '; } ?>  value="Advance Diploma (HND)">Advance Diploma (HND)</option>
                                    <option <?php if ($level == "Post Graduate Diploma") { print ' selected '; } ?>  value="Post Graduate Diploma">Post Graduate Diploma</option>
                                    <option <?php if ($level == "Degree (BSc,BEng,BA...etc)") { print ' selected '; } ?>  value="Degree (BSc,BEng,BA...etc)">Degree (BSc,BEng,BA...etc</option>
                                    <option <?php if ($level == "Master Degree") { print ' selected '; } ?>  value="Master Degree">Master Degree</option>
                                    <option <?php if ($level == "Docterate Degree(Phd)") { print ' selected '; } ?>  value="Docterate Degree(Phd)">Docterate Degree(Phd)</option>
						         
									</select>
									</div>



													
									</div>
									<div class="col-sm-12 col-md-6">
												
									<div class="form-group">
									<label>Country</label>
									<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
									<option disabled value="">Select</option>
						            <?php
									$stmtb = $conn->prepare("SELECT * FROM countries ORDER BY country_name");
                                    $stmtb->execute();
                                    $resultb = $stmtb->fetchAll();

                                    foreach($resultb as $rowb)
                                    {
										?>
										<option <?php if ($ccountry == $rowb['country_name']) { print ' selected '; } ?> value="<?php echo $rowb['country_name']; ?>"><?php echo $rowb['country_name']; ?></option>
										<?php
		
	                                }

                                   
									 ?>
									</select>
									</div>
													
									</div>

						            <div class="col-sm-12 col-md-6">
				
							        <div class="form-group"> 
								    <label>Institution Name</label>
								    <input class="form-control" value="<?php echo "$institution"; ?>" placeholder="Enter institution name" type="text" name="institution" required> 
							        </div>
						
						             </div>
						
						             <div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Course Title</label>
								    <input class="form-control" value="<?php echo "$course"; ?>" placeholder="Enter course name" type="text" name="course" required> 
							        </div>
						
						           </div>
								   
								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Time Frame</label>
								    <input class="form-control" value="<?php echo "$timeframe"; ?>" placeholder="Eg: 2015 To 2016" type="text" name="timeframe" required> 
							        </div>
						
						           </div>

								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Certificate <i>(Leave blank if you dont want to update)</i></label>
								    <input class="form-control" accept="application/pdf" type="file" name="certificate"> 
							        </div>
						
						           </div>
								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Transcript <i>(Leave blank if you dont want to update)</i></label>
								    <input class="form-control" accept="application/pdf" type="file" name="transcript"> 
							        </div>
						
						           </div>
						
					               </div>
				                   </div>
				                   <input type="hidden" name="courseid" value="<?php echo "$course_id"; ?>">
				                   <div class="modal-footer text-center">
				 	               <button type="submit" class="btn btn-primary">Submit</button>
					               <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				                   </div>
				                   </form>
			                       </div>

													</div>
													
	
													
												</div>
												
											</div>
										
										</div>
										
										
										<?php
		
 
	                                }

					  
	                                }catch(PDOException $e)
                                    {
                                 
                                    }
									
									?>



									<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../process/constants/db_config.php';
								try {
                                
                                $stmt = $conn->prepare("SELECT * FROM academic_qualification WHERE member_no = '$myid' ORDER BY id");
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach($result as $row)
                                {
		                        $total_records++;
 
                               	}

					  
	                            }catch(PDOException $e)
                                {
                                echo "Connection failed: " . $e->getMessage();
                                }
	
								$records = $total_records/5;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="academic.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?> href="academic.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="academic.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>

										
									</div>
									
			
						
									<div class="mt-30">
									
										<a data-toggle="modal" href="#QualifModal" class="btn btn-primary btn-lg">Add new</a>
										
									</div>
									<div id="QualifModal" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				                    <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                 <h4 class="modal-title text-center">Add academic qualifications</h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="process/add-academic-qualification.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">
									<div class="col-sm-12 col-md-12">
												
									<div class="form-group">
									<label>Education Level</label>
									<select name="level" required class="selectpicker show-tick form-control" data-live-search="false">
									<option disabled value="">Select</option>
									<option value="Certificate">Certificate</option>
                                    <option value="O Level (WAEC,NECO...etc)">O Level (WAEC,NECO...etc)</option>
                                    <option value="NCE">NCE</option>
                                    <option value="Diploma (OND)">Diploma (OND)</option>
                                    <option value="Advance Diploma (HND)">Advance Diploma (HND)</option>
                                    <option value="Post Graduate Diploma">Post Graduate Diploma</option>
                                    <option value="Degree (BSc,BEng,BA...etc)">Degree (BSc,BEng,BA...etc)</option>
                                    <option value="Master Degree">Master Degree</option>
                                    <option value="Docterate Degree(Phd)">Docterate Degree(Phd)</option>
						         
									</select>
									</div>
													
									</div>
									
									<div class="col-sm-6 col-md-6">
												
									<div class="form-group">
									<label>Country</label>
									<select name="country" required class="selectpicker show-tick form-control" data-live-search="true">
									<option disabled value="">Select</option>
						            <?php
									$stmtb = $conn->prepare("SELECT * FROM countries ORDER BY country_name");
                                    $stmtb->execute();
                                    $resultb = $stmtb->fetchAll();

                                    foreach($resultb as $rowb)
                                    {
										?>
										<option <?php if ($ccountry == $rowb['country_name']) { print ' selected '; } ?> value="<?php echo $rowb['country_name']; ?>"><?php echo $rowb['country_name']; ?></option>
										<?php
		
	                                }
                                   
									 ?>
									</select>
									</div>
													
									</div>
						
					            <div class="col-sm-6 col-md-6">
				
							        <div class="form-group"> 
								    <label>Institution Name</label>
								    <input class="form-control" placeholder="Enter institution name" type="text" name="institution" required> 
							        </div>
						
						             </div>
						
						             <div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Course Title</label>
								    <input class="form-control" placeholder="Enter course name" type="text" name="course" required> 
							        </div>
						
						           </div>
								   
								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Time Frame</label>
								    <input class="form-control" placeholder="Eg: 2015 To 2016" type="text" name="timeframe" required> 
							        </div>
						
						           </div>

								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Attach your certificate</label>
								    <input class="form-control" accept="application/pdf" type="file" name="certificate" required> 
							        </div>
						
						           </div>
								   
								   	<div class="col-sm-12 col-md-6">
						
							        <div class="form-group"> 
								    <label>Academic Transcript</label>
								    <input class="form-control" accept="application/pdf" type="file" name="transcript" required> 
							        </div>
									
					               </div>
				                   </div>
				
				                   <div class="modal-footer text-center">
				 	               <button type="submit" class="btn btn-primary">Submit</button>
					               <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
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
