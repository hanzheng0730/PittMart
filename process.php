<?php
session_start();
include "db.php";
if (isset($_POST["f_name"])) {
    $user_id = $_SESSION[uid];
	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$street = $_POST['street'];
	$zip = $_POST['zip'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $card_date = $_POST['card_date'];
    $card_code = $_POST['card_code'];
    $card_zip = $_POST['card_zip'];
    $name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";
    $trx_id = time();
    $time = date("Y-m-d H:i:s", $trx_id);

    if(empty($f_name) || empty($l_name) || empty($email)  ||
	empty($mobile) || empty($street) || empty($zip) || empty($city) || empty($state) || empty($card_name) || empty($card_number) || empty($card_code) || empty($card_zip)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Some fields are missing.</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $f_name is not valid.</b>
			</div>
		";
		exit();
        }
        if(!preg_match($name,$l_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $l_name is not valid.</b>
			</div>
		";
		exit();
        }
        if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid.</b>
			</div>
		";
		exit();
        }
        if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
        }
        if(!(strlen($mobile) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();
        }
        
        $sql = "SELECT p_id,qty FROM cart WHERE c_id = '$user_id'";
        $query = mysqli_query($con,$sql);
        if (mysqli_num_rows($query) > 0) {
            while ($row=mysqli_fetch_array($query)) {
                $product_id[] = $row["p_id"];
                $qty[] = $row["qty"];
            }
            // select a store nearby
            $sql = "SELECT store_id,zip FROM stores ORDER BY ABS( zip - '$zip') LIMIT 1";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $store_id = $row["store_id"];
            
            // select a sales person
            $sql = "SELECT employee_id,email FROM employees WHERE store_id = '$store_id' ORDER BY RAND() LIMIT 1";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $employee_id = $row["employee_id"];
            
            // insert order
            for ($i=0; $i < count($product_id); $i++) {
                $sql = "INSERT INTO order_detail (order_detail_id,o_id,p_id,c_id,qty,store_id,employee_id,shipping_st,city,state,zip,time) VALUES (NULL,'$trx_id','".$product_id[$i]."','$user_id','".$qty[$i]."','$store_id','$employee_id','$street','$city','$state','$zip','$time')";
                mysqli_query($con,$sql);
                
                // update products amount
                $sql = "UPDATE products SET inventory_amount = inventory_amount - ".$qty[$i]." WHERE product_id = ".$product_id[$i];
                if(!mysqli_query($con,$sql)){
                    echo "Unfortunately, product ".$product_id[$i]." is already out of stock.";
                    exit();
                }
                
            }
            

            
            
            
            // clear cart
            $sql = "DELETE FROM cart WHERE c_id = '$user_id'";
            
            
            if (mysqli_query($con,$sql)) {
                $_SESSION["trx_id"] = $trx_id;
                $_SESSION["employee_id"] = $employee_id;
                echo "success";
                exit();
            }
        }
	}
	
}



?>






















































