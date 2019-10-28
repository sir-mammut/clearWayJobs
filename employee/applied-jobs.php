
<?php
$title = "Applied Jobs";
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
$page1 = ($page*10)-10;
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
						<li><span>Applied Jobs</span></li>
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
										<li>
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
										<li>
											<a href="attachments.php"><i class="fa fa-folder-open"></i> Other Attachments</a>
										</li>
										<li class="active">
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
									
										<h2>Applied Jobs</h2>
														
									</div>
									
									<div class="resume-list-wrapper">
									
									<?php require 'constants/check_reply.php'; ?>
									<div class="recent-job-wrapper">

								  <?php
                                  require '../process/constants/db_config.php';
								  
								  try {
                                  
                                  $stmt = $conn->prepare("SELECT * FROM job_applications WHERE member_no = '$myid' ORDER BY id DESC LIMIT $page1,10");
                                  $stmt->execute();
                                  $result = $stmt->fetchAll();
                                  foreach($result as $row)
                                  {
									             $post_date = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'd');
                                       $post_month = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'F');
                                       $post_year = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'Y');
								                $job_id = $row['job_id'];								
								                $stmtb = $conn->prepare("SELECT * FROM jobs WHERE job_id = '$job_id'");
                                       $stmtb->execute();
                                       $resultb = $stmtb->fetchAll();
									             foreach($resultb as $rowb)
								                {
									                  $job_title = $rowb['title'];
									                  $jobcountry = $rowb['country'];
									                  $jobtype = $rowb['type'];
                                            $compid = $rowb['company'];
									                  if ($jobtype == "Freelance") {
	                                               $sta = '<div class="job-label label label-success">Freelance</div>';								  
	                                         }
	                                        if ($jobtype == "Part-time") {
	                                              $sta = '<div class="job-label label label-danger">Part-time</div>';						  
	                                        }
	                                       if ($jobtype == "Full-time") {
	                                             $sta = '<div class="job-label label label-warning">Full-time</div>';								  
	                                       }	
									               $stmtc = $conn->prepare("SELECT * FROM users WHERE member_no = '$compid' AND role = 'employer'");
                                         $stmtc->execute();
                                         $resultc = $stmtc->fetchAll();				
									               foreach ($resultc as $rowc) {
									                    $compname = $rowc['first_name'];
									                    $complogo = $rowc['avatar'];					
									               }									
?>
											       <a target="_blank" href="../view-job.php?jobid=<?php echo "$job_id"; ?>" class="recent-job-item clearfix">
								<div class="GridLex-grid-middle">
									<div class="GridLex-col-6_xs-12">
										<div class="job-position">
											<div class="image">
											<?php 
										    if ($complogo == null) {
										    print '<center><img class="autofit3" alt="image"  src="images/blank.png"/></center>';
										    }else{
										    echo '<center><img class="autofit3" alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										    }
										     ?>
											</div>
											<div class="content">
												<h4><?php echo "$job_title"; ?></h4>
												<p><?php echo "$compname"; ?></p>
											</div>
										</div>
									</div>
									<div class="GridLex-col-3_xs-8_xss-12 mt-10-xss">
										<div class="job-location">
											<i class="fa fa-map-marker text-primary"></i> <?php echo "$jobcountry"; ?>
										</div>
									</div>
									<div class="GridLex-col-3_xs-4_xss-12">
                                     <?php echo "$sta"; ?>
										<span class="font12 block spacing1 font400 text-center"><?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></span>
									</div>
								</div>
							</a>
							
							<?php
									}
								 								 
		 	                              }
                                  }catch(PDOException $e)
                                  {

                                  } ?>
	
								  </div>
									<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../process/constants/db_config.php';
								try {
                               
                                $stmt = $conn->prepare("SELECT * FROM job_applications WHERE member_no = '$myid' ORDER BY id");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach($result as $row)
                                {
	                              $total_records++;
	                            }

					  
	                            }catch(PDOException $e)
                                {
                 
                                }
	
								$records = $total_records/10;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="applied-jobs.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?> href="applied-jobs.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="applied-jobs.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>											
										
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
