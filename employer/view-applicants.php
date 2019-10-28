<?php
$title = 'Applicants for the'.$job_title; 
include'include/head.php';
require '../process/constants/settings.php'; 
require 'constants/check-login.php';

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*16)-16;
}					
}else{
$page1 = 0;
$page = 1;	
}

if ($user_online == "true") {
if ($myrole == "employer") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}

if (isset($_GET['jobid'])) {
require'../process/constants/db_config.php';
$job_id = $_GET['jobid'];

try {

$stmt = $conn->prepare("SELECT * FROM jobs WHERE job_id = :jobid AND company = '$myid'");
$stmt->bindParam(':jobid', $job_id);
$stmt->execute();
$result = $stmt->fetchAll();
$rec = count($result);

if ($rec == "0") {
header("location:../");		
}else{

foreach($result as $row)
{
		
$job_title = $row['title'];
}
	
}
					  
}catch(PDOException $e)
{

}
	
}
?>


  <style>
  
    .autofit2 {
	height:63px;
	width:63px;
    object-fit:cover; 
  }
  
  </style>


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
						<li><span>Applicants for the job <b><?php echo "$job_title"; ?></b></</span></li>
					</ol>
					
				</div>
				
			</div>

			<div class="section sm">
			
				<div class="container">
				
					<div class="sorting-wrappper">
			
						<div class="sorting-header">
							<h3 class="sorting-title">Applicants for the job <i><?php echo "$job_title"; ?></i></</h3>
						</div>
						
					</div>
					
					<div class="employee-grid-wrapper">
					
						<div class="GridLex-gap-15-wrappper">
						
							<div class="GridLex-grid-noGutter-equalHeight">
							<?php
							include '../process/constants/db_config.php';
							$stmt = $conn->prepare("SELECT * FROM job_applications WHERE job_id = :jobid ORDER BY id LIMIT $page1,16");
							$stmt->bindParam(':jobid', $job_id);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
							 foreach($result as $row)
                            {
							$post_date = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'd');
                            $post_month = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'F');
                            $post_year = date_format(date_create_from_format('m/d/Y', $row['application_date']), 'Y');
                            $emp_id = $row['member_no'];
							
							$stmtb = $conn->prepare("SELECT * FROM users WHERE role = 'employee' AND member_no = '$emp_id'");
                            $stmtb->execute();
                            $resultb = $stmtb->fetchAll();
							
							foreach ($resultb as $rowb)
							
							{
								$empavatar = $rowb['avatar'];
																
								?>

									<div class="GridLex-col-3_sm-4_xs-6_xss-12">
								
									<div class="employee-grid-item">
									
										<div class="action">
												
											<div class="row gap-10">
											
												<div class="col-xs-6 col-sm-6">
													<div class="text-left">
														<button class="btn"><i class="icon-heart"></i></button> 
													</div>
												</div>
												
												<div class="col-xs-6 col-sm-6">
													<div class="text-right">
														<a class="btn text-right" href="employee-detail.html"><i class="icon-action-redo"></i></a> 
													</div>
												</div>
												
											</div>
											
										</div>
										

										<a target="_blank" href="../employee-detail.php?empid=<?php echo $rowb['member_no']; ?>" class="clearfix">
											
											<div class="image clearfix">
										    <?php 
										    if ($empavatar == null) {
									        print '<center><img class="img-circle autofit2" src="../images/default.jpg" alt="image"  /></center>';
										    }else{
										    echo '<center><img class="img-circle autofit2" alt="image" src="data:image/jpeg;base64,'.base64_encode($empavatar).'"/></center>';	
										    }
										    ?>
											
							

											</div>
											
											<div class="content">
											

												<h4><?php echo $rowb['first_name'] ?> <?php echo $rowb['last_name'] ?></h4>
												<p class="location"><i class="fa fa-map-marker"></i> <?php echo $rowb['country'] ?></p>
												
												<h6 class="text-primary">Education : <?php echo $rowb['education'] ?></h6>
												
                                                <h6 class="text-primary"><?php echo $rowb['title'] ?></h6>
												<?php echo "$post_month"; ?> <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?>
												
											</div>
										
										</a>
										
									</div>
								
								</div>
								
								
								<?php
								
								
							}
		

	                        }
	

							?>
															
							</div>
						
						</div>

					</div>

									<div class="pager-wrapper">
								
						            <ul class="pager-list">
								<?php
								$total_records = 0;
								$stmt = $conn->prepare("SELECT * FROM job_applications WHERE job_id = :jobid ORDER BY id");
								$stmt->bindParam(':jobid', $job_id);
                                $stmt->execute();
                                $result = $stmt->fetchAll();
								    foreach($result as $row)
                                {
									$total_records++;
		
	                            }

								$records = $total_records/16;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="view-applicants.php?jobid='.$job_id.'&page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="view-applicants.php?jobid=<?php echo "$job_id"; ?>&page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="view-applicants.php?jobid='.$job_id.'&page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					         </div>

				</div>
			
			</div>

<!-- Footer -->

<?php
include("include/generalFooter.php");
?>

<!-- End of Footer -->
