
<?php 
require 'process/constants/settings.php'; 
require 'process/constants/check-login.php';


$fromsearch = false;

/*
if(isset($_GET['search']) && $_GET['search'] == "✓") {

}else{

}
*/



if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page=="" || $page=="1"){
        $page1 = 0;
        $page = 1;
     }else{
        $page1 = ($page*16)-16;
     }					
}else{
    $page1 = 0;
    $page = 1;	
}


if (isset($_GET['country']) && ($_GET['category']) ){
    $cate = $_GET['category'];
    $country = $_GET['country'];	
    $query1 = "SELECT * FROM jobs 
                         WHERE category = :cate 
                         AND country = :country
                         ORDER BY enc_id 
                         DESC LIMIT $page1,12";
                                  

    $query2 = "SELECT * FROM jobs 
                         WHERE category = :cate 
                         AND country = :country 
                         ORDER BY enc_id DESC";

    $fromsearch = true;

    $slc_country = "$country";
    $slc_category = "$cate";
    $title = "$slc_category jobs in $slc_country";
}else{
    $query1 = "SELECT * FROM jobs
                         ORDER BY enc_id 
                         DESC LIMIT $page1,12";

    $query2 = "SELECT * FROM jobs
                         ORDER BY  enc_id DESC";	

     $slc_country = "NULL";
     $slc_category = "NULL";	
     $title = "Job List";
}



include("include/generalHeader.php");
?>



<body class="not-transparent-header">
<?php
include("include/notTrHeader.php");
?>

	<div class="main-wrapper"> 
		
			<div class="second-search-result-wrapper">
			
				<div class="container">
				
					<form action="job-list.php" method="GET" autocomplete="off">
					
						<div class="second-search-result-inner">
							<span class="labeling">Search a job</span>
							<div class="row">
							
								<div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
									<div class="form-group form-lg">
										<select class="form-control" name="category" required/>
										<option value="">-Select category-</option>

										 <?php
										 require 'process/constants/db_config.php';
										 try {
                                         $stmt = $conn->prepare("SELECT * FROM categories ORDER BY category");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();

                                         foreach($result as $row)
										 
                                         {
										 $cat = $row['category'];
                                        ?>
										<option  <?php if ($slc_category == "$cat") { print ' selected '; } ?> value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
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
								

								<div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
									<div class="form-group form-lg">
										<select class="form-control" name="country" required/>
										<option value="">-Select country-</option>
										 <?php
										 require 'process/constants/db_config.php';
										 try {
                                         $stmt = $conn->prepare("SELECT * FROM countries ORDER BY country_name");
                                         $stmt->execute();
                                         $result = $stmt->fetchAll();

                                         foreach($result as $row)
										
                                         {
											  $cnt = $row['country_name'];
                                        ?>
										
										<option <?php if ($slc_country == "$cnt") { print ' selected '; } ?> value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
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
								
								<div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
									<button name="search" value="✓" type="submit" class="btn btn-block">Search</button>
								</div>
							
							</div>
						</div>
					
					</form>
					
				</div>
			
			</div>


			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Home</a></li>
						<li><span><?php echo "$title"; ?></span></li>
					</ol>
					
				</div>
				
			</div>
			
			<div class="section sm">
			
				<div class="container">
				
					<div class="sorting-wrappper">
			
						<div class="sorting-header">
							<h3 class="sorting-title"><?php echo "$title"; ?></h3>
						</div>
						
		
					</div>
					
					<div class="result-wrapper">
					
						<div class="row">
						
							<div class="col-sm-12 col-md-12 mt-25">
							
								<div class="result-list-wrapper">

								<?php
								require 'process/constants/db_config.php';
								
								try {
                                $stmt = $conn->prepare($query1);
								if ($fromsearch == true) {
								$stmt->bindParam(':cate', $slc_category);
                                $stmt->bindParam(':country', $slc_country);	
								}
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach($result as $row)
                                {
								$post_date = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'd');
                                $post_month = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'F');
                                $post_year = date_format(date_create_from_format('d/m/Y', $row['closing_date']), 'Y');
								$type = $row['type'];
								$compid = $row['company'];

						
								$stmtb = $conn->prepare("SELECT * FROM users WHERE member_no = '$compid' and role = 'employer'");
                                $stmtb->execute();
                                $resultb = $stmtb->fetchAll();
                                foreach($resultb as $rowb) {
								$complogo = $rowb['avatar'];
								$thecompname = $rowb['first_name'];	

									
								}
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
										echo '<center><img class="autofit3" alt="image" title="'.$thecompname.'" width="180" height="100" src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
										}
										 ?>
										</div>


										
										<div class="content">
											<div class="job-item-list-info">
											
												<div class="row">
												
													<div class="col-sm-7 col-md-8">
													
														<h4 class="heading"><?php echo $row['title']; ?></h4>
														<div class="meta-div clearfix mb-25">
															<span>at <a href="company.php?ref=<?php echo "$compid"; ?>"><?php echo "$thecompname"; ?></a></span>
															<?php echo "$sta"; ?>
														</div>
														
														<p class="texing character_limit"><?php echo $row['description']; ?></p>
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

                                } ?>
                                </div>


					
								<div class="pager-wrapper">
								
						        <ul class="pager-list">
								<?php
								$total_records = 0;
								require 'process/constants/db_config.php';
								
								try {
            
                                $stmt = $conn->prepare($query2);
								if ($fromsearch == true) {
								$stmt->bindParam(':cate', $slc_category);
                                $stmt->bindParam(':country', $slc_country);	
								}
                                $stmt->execute();
                                $result = $stmt->fetchAll();
 
                                foreach($result as $row)
                                {
		                        $total_records++;
                                }

					  
	                            }catch(PDOException $e)
                                {

                                }
	
                                $records = $total_records/12;
                                $records = ceil($records);
				                     if ($records > 1 ) {
						                		$prevpage = $page - 1;
							                	$nextpage = $page + 1;

					                  		print '<li class="paging-nav" ';
                                             if ($page == "1") {
                                                 print 'class="disabled"';
                                             }
                                      print '><a '; 
                                            if ($page == "1") { 
                                                  print '';
                                            }     
                                            else { 
                                                  print 'href="job-list.php?page='.$prevpage.''; ?>
                          <?php 
                                    if ($fromsearch == true) { 
                                         print '&category='.$cate.'&country='.$country.'&search=✓'; }'';} print '"><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {


                          ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="job-list.php?page=<?php echo "$b"; ?><?php if ($fromsearch == true) { print '&category='.$cate.'&country='.$country.'&search=✓'; }?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="job-list.php?page='.$nextpage.''; ?> <?php if ($fromsearch == true) { print '&category='.$cate.'&country='.$country.'&search=✓'; }'';} print '"><i class="fa fa-chevron-right"></i></a></li>';
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

<!-- end footer -->
