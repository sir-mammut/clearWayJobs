<?php
require 'process/constants/settings.php'; 
require 'process/constants/check-login.php';
require 'process/constants/db_config.php'; 

if (isset($_GET['jobid'])) {

$jobid = $_GET['jobid'];



try {
	
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE job_id = :jobid");
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
	$opendate = $row['date_posted'];
	$compid = $row['company'];
	if ($jobtype == "Freelance") {
	$sta = '<span class="label label-success">Freelance</span>';
											  
	}
	if ($jobtype == "Part-time") {
	$sta = '<span class="label label-danger">Part-time</span>';
											  
	}
	if ($jobtype == "Full-time") {
	$sta = '<span class="label label-warning">Full-time</span>';
											  
	}

	
	}
	}

					  
	}catch(PDOException $e)
    {
        echo $e->getMessage();
    }


}else{
header("location:./");	
}

try {
	
$stmt = $conn->prepare("SELECT * FROM users WHERE member_no = '$compid'");
$stmt->execute();
$result = $stmt->fetchAll();


    foreach($result as $row)
    {
    $compname = $row['first_name'];
	$complogo = $row['avatar'];
	$compbout = $row['about'];
	}

					  
	}catch(PDOException $e)
    {
        echo $e->getMessage();
    }
	

$today_date = strtotime(date('Y/m/d'));
$last_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y/m/d');
$post_date = date_format(date_create_from_format('d/m/Y', $closingdate), 'd');
$post_month = date_format(date_create_from_format('d/m/Y', $closingdate), 'F');
$post_year = date_format(date_create_from_format('d/m/Y', $closingdate), 'Y');
$conv_date = strtotime($last_date);

if ($today_date > $conv_date){
$jobexpired = true;
}else{
$jobexpired = false;
}

$title = $jobtitle;
include'include/generalHeader.php';

?>

	 <script type="text/javascript">
   function update(str)
   {
	   
	var txt;
    var r = confirm("Are you sure you want to apply this job , you can not UNDO");
    if (r == true) {
		document.getElementById("data").innerHTML = "Please wait...";
         var xmlhttp;

      if(window.XMLHttpRequest)
      {
        xmlhttp=new XMLHttpRequest();
      }
      else
      {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }	

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","process/apply-job.php?opt="+str, true);
      xmlhttp.send();
    } else {

    }

  }
</script>

<body class="not-transparent-header">


<?php
include("include/notTrHeader.php");
?>


			<div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">Create your account for free</h4>
				</div>
				
				<div class="modal-body">
				
					<div class="row gap-20">
					
						<div class="col-sm-6 col-md-6">
							<a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Register as Employer</a>
						</div>
						<div class="col-sm-6 col-md-6">
							<a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Employee</a>
						</div>

					</div>
				
				</div>
				
				<div class="modal-footer text-center">
					<button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
				</div>
				
			</div>




		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="job-list.php">All jobs</a></li>
						<li><a target="_blank" href="company.php?ref=<?php echo "$compid"; ?>"><?php echo "$compname"; ?></a></li>
						<li><span><?php echo "$jobtitle"; ?></span></li>
					</ol>
					
				</div>
				
			</div>
			

			<div class="section sm">
			
				<div class="container">
				
					<div class="row">
						
						<div class="col-md-10 col-md-offset-1">
						
							<div class="job-detail-wrapper">
							
								<div class="job-detail-header text-center">
											
									<h2 class="heading mb-15"><?php echo "$jobtitle"; ?></h2>
								
									<div class="meta-div clearfix mb-25">
										<span>at <a target="_blank" href="company.php?ref=<?php echo "$compid"; ?>"><?php echo "$compname"; ?></a> as </span>
										<?php echo "$sta"; ?>
									</div>
									
									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Location:</h4>
											<?php echo "$jobcity"; ?> , <?php echo "$jobcountry"; ?>
										</li>
										<li>
											<h4 class="heading">Deadline:</h4>
											<?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
										</li>
										<li>
											<h4 class="heading">Experience</h4>
											<?php echo "$experience"; ?> 
										</li>
										<li>
											<h4 class="heading">Posted: </h4>
											<?php echo "$opendate"; ?>
										</li>
									</ul>
									
								</div>
					

	
								<div class="job-detail-company-overview clearfix">
								
									<h3>Company overview</h3>
									<div class="image">
										<?php 
										if ($complogo == null) {
										print '<center>No Company Logo</center>';
										}else{
										echo '<center><img class="autofit2" alt="image" title="'.$compname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										?>
									</div>
									
									<p><?php echo "$compbout"; ?></p>
									
								</div>
								

								<div class="job-detail-content mt-30 clearfix">
								
									<h3>Job Description</h3>

									<p><?php echo "$jobdescription"; ?></p>

									


									<h3>Job Responsibilities</h3>
									
                                    <p><?php echo "$jobrespo"; ?></p>
									
									<h3>Requirements:</h3>
                                    <p><?php echo "$jobreq"; ?></p>
								
								</div>
								
								<div class="apply-job-wrapper">
								<?php
						        if ($user_online == true) {
								if ($jobexpired == true) {
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-calendar"></i> This job is expired</button>';
								}else{
								if ($myrole == "employee") {
                                print '<button';?> onclick="update(this.value)" <?php print ' value="'.$jobid.'" class="btn btn-primary btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-pencil"></i> Apply this job</button>';
								}else{
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-padlock"></i> Login as employee to apply</button>';
								}	
								}

								
								}else{
									
								print '<button class="btn btn-primary disabled btn-hidden btn-lg collapsed"><i class="flaticon-line-icon-set-padlock"></i> Login to apply this job</button>';	
								}
								
								?>

								
								<p id="data"></p>

								</div>
								
								<div class="tab-style-01">
								
									<ul class="nav" role="tablist">
										<li role="presentation" class="active"><h4><a href="#relatedJob1" role="tab" data-toggle="tab">More jobs from <?php echo "$compname"; ?></a></h4></li>
									</ul>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="relatedJob1">
											<div class="tab-content-inner">
							<div class="recent-job-wrapper alt-stripe mr-0">



							<?php
							require 'process/constants/db_config.php';
							try {
                           
                            $stmt = $conn->prepare("SELECT * FROM jobs WHERE company = '$compid' AND job_id != :jobid ORDER BY rand() LIMIT 5");
							$stmt->bindParam(':jobid', $jobid);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
  

                            foreach($result as $row) {
							$post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                            $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                            $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');
                            $jobtype = $row['type'];
							
							$jobtype = $row['type'];


							if ($jobtype == "Freelance") {
	                        $sta = '<div class="job-label label label-success">
									Freelance
									</div>';
											  
	                        }
	                        if ($jobtype == "Part-time") {
	                        $sta = '<div class="job-label label label-danger">
									Part-time
									</div>';
											  
	                        }
	                        if ($jobtype == "Full-time") {
	                              $sta = '<div class="job-label label label-warning">
									Full-time
									</div>';
											  
	                        }
							
							?>
											

																<a href="view-job.php?jobid=<?php echo $row['job_id']; ?>" class="recent-job-item clearfix">
														<div class="GridLex-grid-middle">
															<div class="GridLex-col-6_sm-12_xs-12">
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
																		<h4><?php echo $row['title']; ?></h4>
																		<p><?php echo "$compname"; ?></p>
																	</div>
																</div>
															</div>
															<div class="GridLex-col-3_sm-8-xs-8_xss-12 mt-10-xss">
																<div class="job-location">
																	<i class="fa fa-map-marker text-primary"></i> <?php echo $row['country']; ?>
																</div>
															</div>
															<div class="GridLex-col-3_sm-4_xs-4_xss-12">
                                                             <?php echo "$sta"; ?>
																<span class="font12 block spacing1 font400 text-center"> Due - <?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></span>
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
						
						</div>
						
					</div>
				
				</div>
			
			</div>




















<!-- Footer -->

<?php
include("include/generalFooter.php");
?>

<!-- End of Footer -->
