
<?php
$title = 'My Jobs';
include'include/head.php';
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
       include("include/employerHeader.php");
   ?>




		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Home</a></li>
                 <li><a href="./"><?php echo "$compname"; ?></a></li>
						<li><span>My Jobs</span></li>
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
										<li >
											<a href="./"><i class="fa fa-user"></i> Profile</a>
										</li>
										<li class="">
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
										</li>
			
										<li>
											<a href="../company.php?ref=<?php echo "$myid"; ?>"><i class="fa fa-briefcase"></i> Company Overview</a>
										</li>
										<li  class="active">
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
									
										<h2>Posted Jobs</h2>
										
									</div>
									<?php require 'constants/check_reply.php'; ?>
										<div class="job-item-grid-wrapper">
															
										<div class="GridLex-gap-30">
										
											<div class="GridLex-grid-noGutter-equalHeight">

									<?php
										require '../process/constants/db_config.php';
										try {
                                      
                                        $stmt = $conn->prepare("SELECT * FROM jobs WHERE company = '$myid' ORDER BY enc_id DESC LIMIT $page1,5");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
   
                                        foreach($result as $row)
                                        {
										   $jobcity = $row['city'];
										   $jobcountry = $row['country'];
										   $type = $row['type'];
										   $title = $row['title'];
										   $deadline = $row['closing_date'];
										   if ($type == "Freelance") {
											 $sta = '<span class="label label-success">Freelance</span>';
											  
										   }
										   if ($type == "Part-time") {
											 $sta = '<span class="label label-danger">Part-time</span>';
											  
										   }
										   if ($type == "Full-time") {
											 $sta = '<span class="label label-warning">Full-time</span>';
											  
										   }
										   
										   ?>

										   										  <div class="GridLex-col-4_sm-6_xs-6_xss-12">
												
											<div class="job-item-grid">
													

											<div class="labeling">
											<?php echo "$sta"; ?>
											</div>
														
											<a target="_blank" href="../view-job.php?jobid=<?php echo $row['job_id']; ?>">
														
											<div class="image">
															
											<div class="vertical-middle">
																

											<?php 
										    if ($logo == null) {
										     print '<center>Company Logo Here</center>';
										    }else{
										    echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($logo).'"/></center>';	
										     }
										     ?>
																
											</div>
																
											</div>
														

											<div class="content">
											<h4 class="heading"><?php echo "$title"; ?></h4>
											<p class="location"><i class="fa fa-map-marker text-primary"></i> <strong class="text-primary"><?php echo "$jobcountry" ?></strong> - <?php echo "$jobcity" ?></p>
											<p class="date text-muted font12 font-italic">Deadline - <?php echo "$deadline"; ?></p>
											</div>
															
											</a>
														
											<div class="content-bottom">
											<div class="sub-category">
											<a target="_blank" href="view-applicants.php?jobid=<?php echo $row['job_id']; ?>">Applicants</a>
											<a href="edit-job.php?jobid=<?php echo $row['job_id']; ?>">Edit Job</a>
											<a onclick = "return confirm('Are you sure you want to delete this job ?')" href="process/delete-job.php?id=<?php echo $row['job_id']; ?>">Delete Job</a>
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
											</div>
											
										</div>
										
									</div>

								<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../process/constants/db_config.php';
								try {
                                
                                $stmt = $conn->prepare("SELECT * FROM jobs WHERE company = '$myid' ORDER BY enc_id");
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
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="my-jobs.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" <?php if ($b == $page ) { print 'class="active"'; } ?> ><a href="my-jobs.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="my-jobs.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
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
















<!-- Footer -->

<?php
include("include/generalFooter.php");
?>

<!-- End of Footer -->

