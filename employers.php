
<?php 

$title ="Employers";
include'include/generalHeader.php';
require 'process/constants/settings.php'; 
require 'process/constants/check-login.php';

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
?>


  <style>
  
    .autofit3 {
	height:100px;
	width:100px;
    object-fit:cover; 
  }
  
  </style>

<body class="not-transparent-header">

<?php
include'include/notTrHeader.php';
?>

		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><a href="./">Home</a></li>
						<li><span>Employers</span></li>
					</ol>
					
				</div>
				
			</div>

			<div class="section sm">
			
				<div class="container">
				
					<div class="sorting-wrappper alt">
			
						<div class="GridLex-grid-middle">
						
							<div class="GridLex-col-3_sm-12_xs-12">
							
								<div class="sorting-header">
									<h3 class="sorting-title">Employers</h3>
								</div>
								
							</div>
							
							
						</div>

					</div>
			

					<div class="company-grid-wrapper top-company-2-wrapper">

						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">
							<?php
							require 'process/constants/db_config.php';
							try {
                         
                            $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'employer' ORDER BY first_name LIMIT $page1,16");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
		                    $complogo = $row['avatar'];
                          $comp_id = $row['member_no'];
/*Displaying number of job being posted by employers*/

    $stmt0 = $conn->prepare("SELECT * FROM jobs WHERE company = '$comp_id' ");
                                        $stmt0->execute();
                                        $result0 = $stmt0->fetchAll();
                                        $rec = count($result0);
/*REC will return number of job posted by individual company*/
							?>
							<div class="GridLex-col-3_sm-4_xs-6_xss-12">
								
							<div class="top-company-2">
							<a target="_blank" href="company.php?ref=<?php echo $row['member_no']; ?>">
										
							<div class="image">
							<?php 
							if ($complogo == null) {
							print '<center><img class="autofit3" alt="image"  src="include/images/blank.png"/></center>';
							}else{
							echo '<center><img class="autofit3" alt="image"  src="data:image/jpeg;base64,'.base64_encode($complogo).'"/></center>';	
							}
							?>
		
							</div>
											

							<div class="content">
							<h5 class="heading text-primary font700"><?php echo $row['first_name'];?></h5>
							<p class="texting font600"><?php echo $row['title'];?><p>

<?php if($rec==0){ ?>
                 <span class="font15">No jobs Posted yet</span>
         <?php   }else{ ?>
							<p class="mata-p clearfix"><span class="text-primary font700"><?php echo $rec; ?></span> <span class="font13">Active job(s)</span> <span class="pull-right icon"><i class="fa fa-long-arrow-right"></i></span></p>
                  <?php } /*end if*/ ?>
							</div>
										
							</a>
										
							</div>
									
							</div>
							<?php
	
	                        }

	                        }catch(PDOException $e)
                             {
                                $e->getMessage();
                             }
 ?>
		
							</div>
						
						</div>

					</div>
					
								<div class="pager-wrapper">
								
						        <ul class="pager-list">
							<?php
							require 'process/constants/db_config.php';
							$total_records = 0;
							try {
                      	
                            $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'employer' ORDER BY first_name");
                            $stmt->execute();
                            $result = $stmt->fetchAll();

                            foreach($result as $row)
                            {
                            $total_records++;
	
	                        }

	                        }catch(PDOException $e)
                             {
                      
                             } ?>



								<?php
								$records = $total_records/16;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="employers.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" ><a <?php if ($b == $page) { print ' style="background-color:#33B6CB; color:white" '; } ?>  href="employers.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="employers.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
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
