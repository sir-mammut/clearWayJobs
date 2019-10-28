
<?php 
include 'process/constants/settings.php'; 
include 'process/constants/check-login.php';


include("include/generalHeader.php");
?>
<body class="not-transparent-header">

<?php
include("include/notTrHeader.php");
?>
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list">
						<li><a href="./">Home</a></li>
						<li><span>Register</span></li>
					</ol>
					
				</div>
				
			</div>




		<div class="main-wrapper">

			<div class="login-container-wrapper">	
	
				<div class="container">
				
					<div class="row">
					
						<div class="col-md-10 col-md-offset-1">
						
							<div class="row">

								<div class="col-sm-6 col-sm-offset-3">


        <?php
								include 'process/constants/check_reply.php';	
								?>
								
                                <?php
							
								if (isset($_GET['p'])) {
								$position = $_GET['p'];
                                if ($position == "Employee") {
                                include 'process/constants/draw-employee.php';
								}else{
                               
								}	

                                if ($position == "Employer") {
                                include 'process/constants/draw-employer.php';
								}else{

								}								
								}else{
		                        
								}
								
								?>

									
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
