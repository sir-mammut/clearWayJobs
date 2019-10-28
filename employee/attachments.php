
<?php
$title = "Other Attachments";
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
						<li><span>Other Attachments</span></li>
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
										<li>
											<a href="academic.php"><i class="fa fa-graduation-cap"></i> Academic Qualifications</a>
										</li>
										<li>
											<a href="experience.php"><i class="fa fa-briefcase"></i> Working Experience</a>
										</li>
										<li class="active">
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
									
										<h2>Other Attachments</h2>
															
									</div>
									
									<div class="resume-list-wrapper">
									<?php require 'constants/check_reply.php'; ?>
									<?php
									require '../process/constants/db_config.php';
									try {
                                   
                                    $stmt = $conn->prepare("SELECT * FROM other_attachments WHERE member_no = '$myid' ORDER BY id LIMIT $page1,5");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row)
                                    {
									 $att_title = $row['title'];
									 $att_issuer = $row['issuer'];
									 $att_id = $row['id'];
									 ?>
									 									<div class="resume-list-item">
										
											<div class="row">
											
												<div class="col-sm-12 col-md-10">
												
													<div class="content">
													
														<a  target="_blank" href="view-attachment.php?id=<?php echo $row['id']; ?>" >

															<div class="image">
															<?php 
										                    if ($myavatar == null) {
									                    	print '<center><img src="../include/images/default.jpg" title="'.$myfname.'" alt="image" width="100" height="100" /></center>';
										                    }else{
										                    echo '<center><img alt="image" title="'.$myfname.'" width="100" height="100" src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										                    }
										                      ?>
															</div>
															
															<h4><?php echo $row['title']; ?></h4>
															
															<div class="row">
																<div class="col-sm-12 col-md-9">
																	<i class="fa fa-building text-primary mr-5"></i><strong class="mr-10"><?php echo $row['issuer']; ?></strong>
																</div>

															</div>

														</a>
													
													</div>
												
												</div>


												
												<div class="col-sm-12 col-md-2">
													
													<div class="resume-list-btn">
													
									<a data-toggle="modal" href="#edit<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-5 mb-0-sm">Edit</a>
									<a href="process/delete-attachment.php?id=<?php echo $row['id']; ?>" onclick = "return confirm('Are you sure you want to delete this attachment ?')" class="btn btn-primary btn-sm btn-inverse">Delete</a>
									<div id="edit<?php echo $row['id']; ?>" class="modal fade login-box-wrapper" tabindex="-1" data-width="550" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				                    <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                 <h4 class="modal-title text-center"><?php echo "$att_title"; ?></h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="process/update-attachment.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">

						
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Attachment Type</label>
								    <input class="form-control" value="<?php echo "$att_title"; ?>" placeholder="Eg: birth certificate, driving licence" type="text" name="title" required> 
							        </div>
						
						             </div>
						
						             <div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Issuer</label>
								    <input class="form-control" value="<?php echo "$att_issuer"; ?>" placeholder="Enter issuer" type="text" name="issuer" required> 
							        </div>
						
						           </div>
								  

								   	<div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Select Attachment <i>(Leave blank if you dont want to update)</i></label>
								    <input class="form-control" accept="application/pdf" type="file" name="certificate"> 
							        </div>
						
						           </div>
						
	
						           </div>
				                   </div>
				                   <input type="hidden" name="attid" value="<?php echo "$att_id"; ?>">
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
                                    
                                    $stmt = $conn->prepare("SELECT * FROM other_attachments WHERE member_no = '$myid' ORDER BY id");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach($result as $row)
                                    {
										$total_records++;
	
 
                                	}

					  
	                                }catch(PDOException $e)
                                    {
   
                                    }



		
								$records = $total_records/5;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="attachments.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?> href="attachments.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="attachments.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
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
					                 <h4 class="modal-title text-center">Add Attachments</h4>
				                    </div>
				
				                    <div class="modal-body">
									<form action="process/add-attachment.php" method="POST" autocomplete="off" enctype="multipart/form-data">
					                <div class="row gap-20">

						
						            <div class="col-sm-12 col-md-12">
				
							        <div class="form-group"> 
								    <label>Attachment Type</label>
								    <input class="form-control" placeholder="Eg: birth certificate, driving licence" type="text" name="title" required> 
							        </div>
						
						             </div>
						
						             <div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Issuer</label>
								    <input class="form-control" placeholder="Enter issuer" type="text" name="issuer" required> 
							        </div>
						
						           </div>
								  

								   	<div class="col-sm-12 col-md-12">
						
							        <div class="form-group"> 
								    <label>Select Attachment</label>
								    <input class="form-control" accept="application/pdf" type="file" name="certificate" required> 
							        </div>
						
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
