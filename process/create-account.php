<?php
date_default_timezone_set('Africa/Nigeria');

if (isset($_POST['reg_mode'])) {
       checkemail();	
}else{
       header("location:../");		
}


function checkemail() {
	
try {
	require 'constants/db_config.php';
 

	$email = $_POST['email'];
	$account_type = $_POST['acctype'];
	
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");

	 $stmt->bindParam(':email', $email);

    $stmt->execute();
    $result = $stmt->fetchAll();

	 $records = count($result);
	
	 if ($account_type == "101") {
	      $role = "Employee";	
	}else{
	      $role = "Employer";	
	}
	
	if ($records > 0) {
	    header("location:../register.php?p=$role&r=0927");	
		
	}else{
	
      	if ($account_type == "101") {
   	        register_as_employee();
	      }else{
          	register_as_employer();
	    }
	
		
   	}


	}catch(PDOException $e)
    {
        header("location:../register.php?p=$role&r=4568");
    }
}


//function that register an employee

function register_as_employee() {

try {
	 require 'constants/db_config.php';
	 require 'constants/uniques.php';


	$role = 'employee';
    $account_type = $_POST['acctype'];

    $nowT = date('h:m A');
    $nowD = date('d-m-Y');
    $last_login = "at ".$nowT." on ".$nowD;
	$member_no = 'EM'.get_rand_numbers(9).'';
    $fname = ucwords($_POST['fname']);
    $lname = ucwords($_POST['lname']);
    $email = $_POST['email'];
    $password = md5($_POST['password']);

	
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, last_login, password, role, member_no) 
	VALUES (:fname, :lname, :email, :lastlogin, :password, :role, :memberno)");

    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
	 $stmt->bindParam(':lastlogin', $last_login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
	 $stmt->bindParam(':memberno', $member_no);
    $stmt->execute();
	 header("location:../register.php?p=Employee&r=1123");				  
	}catch(PDOException $e)
    {
       header("location:../register.php?p=Employee&r=4568");
    }	
	
}


function register_as_employer() {
try {
	require 'constants/db_config.php';
	require 'constants/uniques.php';


	 $role = 'employer';
    $account_type = $_POST['acctype'];

    $nowT = date('h:m A');
    $nowD = date('d-m-Y');
    $last_login = "at ".$nowT." on ".$nowD;

    $comp_no = 'CM'.get_rand_numbers(9).'';
    $cname = ucwords($_POST['company']);
    $ctype = ucwords($_POST['type']);
    $email = $_POST['email'];
    $password = md5($_POST['password']);
	
    $stmt = $conn->prepare("INSERT INTO users (first_name, title, email, last_login, password, role, member_no) 
	VALUES (:fname, :title, :email, :lastlogin, :password, :role, :memberno)");
    $stmt->bindParam(':fname', $cname);
    $stmt->bindParam(':title', $ctype);
    $stmt->bindParam(':email', $email);
	 $stmt->bindParam(':lastlogin', $last_login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
	 $stmt->bindParam(':memberno', $comp_no);
    $stmt->execute();
	 header("location:../register.php?p=Employer&r=1123");				  
	}catch(PDOException $e)
    {
       header("location:../register.php?p=Employer&r=4568");
    }	
	
}

?>

