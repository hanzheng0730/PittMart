<?php
session_start();
include "db.php";
    
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
    
//debug_to_console( "register.php" );
    
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$phone = $_POST['phone'];
	$street = $_POST['street'];
	$city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $home_or_business = $_POST['home_business'];
    $business_category = $_POST['business_cat'];
    $annual_income = $_POST['income'];
    $married = $_POST['m_status'];
    $gender = $_POST['gender'];
    $birth_year = $_POST['b_year'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
	empty($phone) || empty($street) || empty($city) || empty($state) || empty($zip)){
		
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button><b>Please fill all required fields.</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>this $f_name is not valid.</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$l_name)){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>this $l_name is not valid.</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>this $email is not valid.</b>
			</div>
		";
		exit();
	}
	if(strlen($password) < 6 ){
		echo "
			<div class='alert alert-warning'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Password is too short.</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 6 ){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Password is too short.</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Password is not same.</b>
			</div>
		";
	}
	if(!preg_match($number,$phone)){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Phone number $phone is not valid.</b>
			</div>
		";
		exit();
	}
	if(!(strlen($phone) == 10)){
		echo "
			<div class='alert alert-warning'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Phone number must be 10 digit.</b>
			</div>
		";
		exit();
	}
	//existing email address in our database
	$sql = "SELECT customer_id FROM customers WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
				<b>Email address is already registered.</b>
			</div>
		";
		exit();
	} else {
		$password = md5($password);
		$sql = "INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `password`, `phone_number`, `email`,  `street`, `city`, `state`, `zip`, `home_or_business`, `business_category`, `annual_income`, `married`, `gender`, `birth_year`) VALUES (NULL, '$f_name', '$l_name', '$password', '$phone', '$email', '$street', '$city', '$state', '$zip', '$home_or_business', '$business_category', '$annual_income', '$married', '$gender', '$birth_year')";
		$run_query = mysqli_query($con,$sql);
        
		$_SESSION["uid"] = mysqli_insert_id($con);
        //debug_to_console( $_SESSION["uid"]);
        
		$_SESSION["name"] = $f_name;
        
		$ip_add = getenv("REMOTE_ADDR");
		$sql = "UPDATE cart SET c_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND c_id = -1";
		if(mysqli_query($con,$sql)){
			echo "register_success";
			exit();
		}
	}
}
	
}



?>






















































