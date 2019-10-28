<?php
/*
created by Mhizta Mammut
Started on 06/07/2018

*/

$title = "Job Portal";

include 'process/constants/settings.php'; 
include 'process/constants/check-login.php';

include("include/generalHeader.php");

?>
  <style>
  
    .autofit2 {
	height:70px;
	width:500px;
    object-fit:cover; 
  }
  
      .autofit3 {
	height:80px;
	width:100px;
    object-fit:cover; 
  }
  

  </style>


<body class="home">

	<!-- <div id="introLoader" class="introLoading"></div> -->

	<div class="container-wrapper">
   <?php
       include("include/homeHeader.php");
   ?>

  
		<div class="main-wrapper">
			<div class="hero" style="background-image:url('include/images/hero-header/banner.jpg');">
				<div class="container">
    
					<h1>your future start here now</h1>
					<p>Finding your next job or career in ClearWay Jobs portal</p>

              <div class="main-search-form-wrapper">
					
						<form action="job-list.php" method="GET" autocomplete="off">
					
							<div class="form-holder">
								<div class="row gap-0">
								
									<div class="col-xss-6 col-xs-6 col-sm-6">

										<select class="form-control" name="category" required/>
										<option value="">-Select category-</option>

										 <?php
										 require('process/constants/db_config.php');
										 try { 
                                    
                                         $stmt = $conn->prepare("SELECT * FROM categories ORDER BY category");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();

                                         foreach($result as $row)
                                         {
                                        ?>
										
										<option style="color:black" value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
										<?php
	                                     }
                                         $stmt->execute();
					  
	                                     }catch(PDOException $e)
                                         {
        
                                         }
	
										?>
														   
										</select>

									</div>
									
									<div class="col-xss-6 col-xs-6 col-sm-6">
										<select class="form-control"  name="country" required/>
										<option value="">-Select country-</option>
										 <?php
										 require('process/constants/db_config.php');
										 try {
	
                                         $stmt = $conn->prepare("SELECT * FROM countries ORDER BY country_name");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();

                                         foreach($result as $row)
                                         {
                                        ?>
										
										<option style="color:black" value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
										<?php
	                                     }
                                         $stmt->execute();
					  
	                                     }catch(PDOException $e)
                                         {
               
                                         }
	
										?>

										</select>
									</div>
									
								</div>
							
							</div>
							<div class="btn-holder">
								<button name="search" value="✓" type="submit" class="btn"><i class="ion-android-search"></i></button>
							</div>
						
						</form>
						
					</div>

				</div>
				
			</div>

			<div class="post-hero bg-light">
			
				<div class="container">

					<div class="process-item-wrapper mt-20">
							
						<div class="row">
						
							<div class="col-sm-4">
								
								<div class="process-item clearfix">
									
									<div class="icon">
										<i class="flaticon-line-icon-set-magnification-lens"></i>
									</div>
									
									<div class="content">
										<h5>1 - Search for jobs</h5>
									</div>
									
								</div>
								
							</div>
							
							<div class="col-sm-4">
							
								<div class="process-item clearfix">
									
									<div class="icon">
										<i class="flaticon-line-icon-set-pencil"></i>
									</div>
									
									<div class="content">
										<h5>2 - Apply a Job</h5>
									</div>
									
								</div>
								
							</div>
							
							<div class="col-sm-4">
								
								<div class="process-item clearfix">
									
									<div class="icon">
										<i class="flaticon-line-icon-set-calendar"></i>
									</div>
									
									<div class="content">
										<h5>3 - Start Working</h5>
									</div>
									
								</div>
								
							</div>
							
						</div>
					
					</div>
					
				</div>
			
			</div>


	
		
			

			<div class="pt-0 pb-50">
			
				<div class="container">

					<div class="row">
					
						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						
							<div class="section-title">
							
								<br><h2>Random Companies</h2>
								
							</div>
						
						</div>
					
					</div>
	
					<?php
					require 'process/constants/db_config.php';
					try {

                    $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'employer' ORDER BY rand() LIMIT 8");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach($result as $row) {
					$complogo = $row['avatar'];
					?>


					
					<div class="row top-company-wrapper with-bg">
					<div class="col-xss-12 col-xs-6 col-sm-4 col-md-3">
							
					<div class="top-company">
					<div class="image">
					<?php 
					if ($complogo == null) {
					print '<center><img class="autofit2" alt="image"  src="include/images/blank.png"/></center>';
					}else{
					echo '<center><img class="autofit2" alt="image"  src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
					}
					?>
					</div>

			
					<h6><?php echo $row['first_name'];?></h6>
					<a target="_blank" href="company.php?ref=<?php echo $row['member_no']; ?>">View Company</a>
					</div>
							
			</div><!------------>
					</div>
					<?php
					
                    {

	                }
					  
	                }}catch(PDOException $e)
                    {

                    }
	
					?>
					
					</div>

				</div>

			</div>

			<div class="bg-light pt-80 pb-80">
			
				<div class="container">
				
					<div class="row">
						
						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						
							<div class="section-title">
							
								<h2>Latest Jobs</h2>
								
							</div>
						
						</div>
					
					</div>
					
					<div class="row">
						
						<div class="col-md-12">
						
							<div class="recent-job-wrapper alt-stripe mr-0">



							<?php
							require 'process/constants/db_config.php';
							try {
                           
                            $stmt = $conn->prepare("SELECT * FROM jobs ORDER BY enc_id DESC LIMIT 8");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
  

                            foreach($result as $row) {
							$jobcity = $row['city'];
							$jobcountry = $row['country'];
							$type = $row['type'];
							$title = $row['title'];
							$closingdate = $row['closing_date'];
							$company_id = $row['company'];
							$post_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'd');
                            $post_month = date_format(date_create_from_format('d/m/Y', $closingdate), 'F');
                            $post_year = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y');
										   




							$stmtb = $conn->prepare("SELECT * FROM users WHERE member_no = '$company_id' and role = 'employer'");
                            $stmtb->execute();
                            $resultb = $stmtb->fetchAll();
							foreach($resultb as $rowb) {
							$complogo = $rowb['avatar'];
							$thecompname = $rowb['first_name'];	
								
							}
							
							if ($type == "Freelance") {
							$sta = '<div class="job-label label label-success">
									Freelance
									</div>';
											  
							}
							if ($type == "Part-time") {
							$sta = '<div class="job-label label label-danger">
									Part-time
									</div>';
											  
							}
							if ($type == "Full-time") {
							$sta = '<div class="job-label label label-warning">
									Full-time
									</div>';
											  
							}
							?>



							<a class="recent-job-item clearfix" target="_blank" href="view-job.php?jobid=<?php echo $row['job_id']; ?>">
							<div class="GridLex-grid-middle">
							<div class="GridLex-col-5_xs-12">
							<div class="job-position">
							<div class="image">
							<?php 
							if ($complogo == null) {
							print '<center><img alt="image"  src="images/blank.png"/></center>';
							}else{
							echo '<center><img alt="image" title="'.$thecompname.'" width= "400" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
							}
							?>



							</div>
							<div class="content">
							<h4><?php echo "$title"; ?></h4>
							<p><?php echo "$thecompname"; ?></p>
							</div>
							</div>
							</div>
							<div class="GridLex-col-5_xs-8_xss-12 mt-10-xss">
							<div class="job-location">
							<i class="fa fa-map-marker text-primary"></i> <?php echo "$jobcountry" ?></strong> - <?php echo "$jobcity" ?>
							</div>
							</div>
							<div class="GridLex-col-2_xs-4_xss-12">
							<?php echo "$sta"; ?>
							<span class="font12 block spacing1 font400 text-center">Due - <?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></span>
							</div>
							</div>
							</a>
								
							<?php

                            }
	                        }catch(PDOException $e)
                            { 
                   
                             }
                             ?>



							
							</div>
							
						</div>
						
					</div>
					
				</div>
			
			</div>
	
		</div>
			
	</div><!------------>
  
</div><!------------>










<!-- Footer -->

<?php
include("include/generalFooter.php");
?>

<!-- End of Footer -->
