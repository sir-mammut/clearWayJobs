<?php 
require 'process/constants/settings.php'; 
require 'process/constants/check-login.php';
require 'process/constants/db_config.php';

if (isset($_GET['ref'])) {

$company_id = $_GET['ref'];


    try {
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE member_no = :memberno AND role = 'employer'");
	$stmt->bindParam(':memberno', $company_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$rec = count($result);
	
	if ($rec == "0") {
	header("location:./");	
	}else{

    foreach($result as $row)
    {
		
    $compname = $row['first_name'];
	$compesta = $row['byear'];
    $compmail  = $row['email'];
	$comptype = $row['title'];
    $compphone = $row['phone'];
	$compcity = $row['city'];
	$compstreet = $row['street'];
	$compzip = $row['zip'];
    $compcountry = $row['country'];
    $compbout = $row['about'];
	$complogo = $row['avatar'];
	$compserv = $row['services'];
	$compexp = $row['expertise'];
	$compweb = $row['website'];
	$comppeopl = $row['people'];
	
	}
	
	}

					  
	}catch(PDOException $e)
    {
 
    }
	
}else{
header("location:./");
}


$title = $compname;
include'include/generalHeader.php';

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

<?php
include'include/notTrHeader.php';
?>
	

		<div class="main-wrapper">

	
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="employers.php">Employers</a></li>
						<li><a ><?php echo "$compname"; ?></a></li>
		  			  <li><span>Company Overview</span></li>
                 
					</ol>
					
				</div>
				
			</div>

<!--     


	
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
										<li>
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
										</li>
			
										<li class = "active">
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
    -->




			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
							<div class="col-md-10 col-md-offset-1">
							
								<div class="company-detail-wrapper">
								
									<div class="company-detail-header text-center">
										
										<div class="image">
										<?php 
										if ($complogo == null) {
										print '<center>Company Logo Here</center>';
										}else{
										echo '<center><img alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										?>
										</div>
										
										<h2 class="heading mb-15"><?php echo "$compname"; ?></h2>
									
										<p class="location"><i class="fa fa-map-marker"></i> <?php echo "$compzip"; ?> <?php echo "$compstreet"; ?>,<?php echo "$compcity"; ?>, <?php echo "$compcountry"; ?> <span class="mh-5">|</span> <i class="fa fa-phone"></i> <?php echo "$compphone"; ?></p>
										
										<ul class="meta-list clearfix">
											<li>
												<h4 class="heading">Established In:</h4>
												<?php echo "$compesta"; ?>
											</li>
											<li>
												<h4 class="heading">Type:</h4>
												<?php echo "$comptype"; ?>
											</li>
											<li>
												<h4 class="heading">People:</h4>
												<?php echo "$comppeopl"; ?>
											</li>
											<li>
												<h4 class="heading">Website: </h4>
												<a target="_blank" href="https://<?php echo "$compweb"; ?>"><?php echo "$compweb"; ?></a>
											</li>
										</ul>
										
									</div>
						
									<div class="company-detail-company-overview clearfix">
									
										<h3>Company background</h3>
										
										<p><?php echo "$compbout"; ?></p>

										
										<h3>Services</h3>
										
										<p><?php echo "$compserv"; ?></p>
										
										<h3>Expertise</h3>
										
										<p><?php echo "$compexp"; ?></p>
										
									</div><br><br>

									
									<div class="section-title mb-40">
						
										<h4 class="text-left">jobs offered at <?php echo "$compname"; ?></h4>
										
									</div>


									<div class="result-list-wrapper">
									<?php
									require 'process/constants/db_config.php';
									
									try {
                                    
                                    $stmt = $conn->prepare("SELECT * FROM jobs WHERE company = :compid ORDER BY enc_id DESC LIMIT 5");
                                    $stmt->bindParam(':compid', $company_id);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();

                                    foreach($result as $row)
                                    {
									$post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                                    $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                                    $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');
									$type = $row['type'];
									if ($type == "Freelance") {
									$sta = '<span class="job-label label label-success">Freelance</span>';
											  
									}
									if ($type == "Part-time") {
									$sta = '<span class="job-label label label-danger">Part-time</span>';
											  
									}
									if ($type == "Full-time") {
									$sta = '<span class="job-label label label-warning">Full-time</span>';
											  
									}
									
									?>

										<div class="job-item-list">
										
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
												<div class="job-item-list-info">
												
													<div class="row">
													
														<div class="col-sm-7 col-md-8">
														
															<h4 class="heading"><?php echo $row['title']; ?></h4>
															<div class="meta-div clearfix mb-25">
															<span>at <a href="company.php?ref=<?php echo "$company_id"; ?>"><?php echo "$compname"; ?></a></span>
															<?php echo "$sta"; ?>
															</div>
															
															<p class="texing"><?php echo $row['description']; ?></p>
														</div>
														
														<div class="col-sm-5 col-md-4">
														<ul class="meta-list">
															<li>
																<span>Country:</span>
																<?php echo $row['country']; ?>
															</li>
															<li>
																<span>City:</span>
																<?php echo $row['city']; ?>
															</li>
															<li>
																<span>Experience:</span>
																<?php echo $row['experience']; ?>
															</li>
															<li>
																<span>Deadline: </span>
																<?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
															</li>
														</ul>
														</div>
														
													</div>
												
												</div>
											
												<div class="job-item-list-bottom">
												
													<div class="row">
													
														<div class="col-sm-7 col-md-8">
														<div class="sub-category">
															<a><?php echo $row['category']; ?></a>

														</div>
														</div>
														
													<div class="col-sm-5 col-md-4">
														<a target="_blank" href="view-job.php?jobid=<?php echo $row['job_id']; ?>" class="btn btn-primary">View This Job</a>
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


									</div>
								<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								require'process/constants/db_config.php';
								try {
                                
                                $stmt = $conn->prepare("SELECT * FROM jobs WHERE company = :compid ORDER BY enc_id DESC");
                                $stmt->bindParam(':compid', $company_id);
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
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="company.php?ref='.$company_id.'&page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="company.php?ref=<?php echo "$company_id"; ?>&page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="company.php?ref='.$company_id.'&page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
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


