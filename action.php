<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM product_kinds";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
        <div class='sidebar'>
            <h3>CATEGORIES</h3>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["product_kind_id"];
			$cat_name = $row["product_kind_name"];
			echo "
					<a href='#' class='category' cid='$cid'>$cat_name</a><br>
			";
		}
		echo "
        <a href='#' class='category' cid='-1'>Sale</a><br>
        <a href='#' class='category' cid='0'>Recommendation</a><br>
        </div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
// admin product page

if(isset($_POST["admin_p_page"])){
        $sql = "SELECT product_id FROM products";
        $run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        $pageno = ceil($count/10);
        for($i=1;$i<=$pageno;$i++){
            echo "
            <li><a href='#' page='$i' id='admin_p_page'>$i</a></li>
            ";
        }
}

// admin order page

if(isset($_POST["admin_o_page"])){
        $sql = "SELECT order_detail_id FROM order_detail";
        $run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        $pageno = ceil($count/10);
    
    
        $flag=0;
        for($i=1;$i<=$pageno;$i++){
            if($i<=3 or $i>$pageno-3){
            echo "
            <li><a href='#' page='$i' id='admin_o_page'>$i</a></li>
            ";
            } else if ($flag==0){
                echo '
                <li class="page-item" >
                <input style="height:28px;font-size:12px;visibility:hidden" type="number" class="page_go" id="page_go" min="1" max="'.$pageno.'">
                <span onclick="showPageBox()" class="page-link">&hellip;</span>
                </li>
                <script>
                function showPageBox() {
                    document.getElementById("page_go").style.visibility = "visible";
                }
                </script>
                ';
                $flag = 1;
            }
        }
    
}

// admin customer page

if(isset($_POST["admin_c_page"])){
        $sql = "SELECT customer_id FROM customers";
        $run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        $pageno = ceil($count/10);
    
    
        $flag=0;
        for($i=1;$i<=$pageno;$i++){
            if($i<=3 or $i>$pageno-3){
            echo "
            <li><a href='#' page='$i' id='admin_c_page'>$i</a></li>
            ";
            } else if ($flag==0){
                echo '
                <li class="page-item" >
                <input style="height:28px;font-size:12px;visibility:hidden" type="number" class="cpage_go" id="cpage_go" min="1" max="'.$pageno.'">
                <span onclick="showCPageBox()" class="page-link">&hellip;</span>
                </li>
                <script>
                function showCPageBox() {
                    document.getElementById("cpage_go").style.visibility = "visible";
                }
                </script>
                ';
                $flag = 1;
            }
        }
}    
    
if(isset($_POST["getProduct"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
    //echo $product_query;
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_kind_id'];
			$pro_title = $row['name'];
			$pro_price = $row['price'];
			$pro_image = $row['image'];
            $pro_amount = $row['inventory_amount'];
            $msg="";
            if($pro_amount <=5) $msg='<div style="position: absolute;left:30px;top: 10px;color:#ff6384;">Only '.$pro_amount.' left!</div>';
            if($pro_amount == 0) $msg='<div style="position: absolute;left:11px;top: -2px;"><img width="140" src="images/soldout.png"></div>';
			echo "
				<div class='col-md-3'>
                    <div class='panel panel-default text-center'>
                        <div class='panel-heading'>$msg</div>
                        <div class='panel-body'>
                            <img src='images/$pro_image' style='width:160px; height:100px;'/>
                        </div>
                        <div class='panel-heading'>$pro_title</div>
                        <div class='panel-heading'>
                            $$pro_price<br>
                            <button pid='$pro_id' style='float:center;' id='product' class='btn btn-default btn-xs'>Add to Cart</button>
                        </div>
                    </div>
                </div>
			";
		}
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
        if($id == -1) $sql = "SELECT * FROM products WHERE keywords LIKE '%sale%'";
		else if ($id > 0) $sql = "SELECT * FROM products WHERE product_kind_id = '$id'";
        else {
            if(isset($_SESSION["uid"])){
                $c_id = $_SESSION["uid"];
                // recommend top 5 products using the KNN algorithm
                // xiong
                
                
            } else {
            // recommend top sellers if user is not logged in
                $sql = "select p.product_id, p.product_kind_id, p.name, p.price, p.image, sum(o.qty) as total_sold from products p join order_detail o on p.product_id=o.p_id group by o.p_id order by total_sold DESC limit 5";
            }
        }
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE keywords LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_kind_id'];
			$pro_title = $row['name'];
			$pro_price = $row['price'];
			$pro_image = $row['image'];
			echo "

        <div class='col-md-3'>
            <div class='panel panel-default text-center'>
                <div class='panel-heading'></div>
                <div class='panel-body'>
                    <img src='images/$pro_image' style='width:160px; height:100px;'/>
                </div>
                <div class='panel-heading'>$pro_title $keyword</div>
                <div class='panel-heading'>
                    $$pro_price<br>
                    <button pid='$pro_id' style='float:center;' id='product' class='btn btn-default btn-xs'>Add to Cart</button>
                </div>
            </div>
        </div>
			";
    }
}
	
// admin
    
if(isset($_POST["adminGetProduct"])){
    
    $limit = 10;
    if(isset($_POST["setAdminProdcutPage"])){
        $pageno = $_POST["adminProductPageNumber"];
        $start = ($pageno * $limit) - $limit;
    }else{
        $start = 0;
    }
    
    $cat_query = "SELECT * FROM product_kinds";
    $cat_list = mysqli_query($con,$cat_query);
    $cat_ids = [];
    $cat_names = [];
    
    if (mysqli_num_rows($cat_list) > 0) {
        while ($row=mysqli_fetch_array($cat_list)) {
            $cat_ids[] = $row['product_kind_id'];
            $cat_names[]  = $row['product_kind_name'];
        }
    }
    
    $cat_n= count($cat_names);
    
    $cat_selector = "<select class=\"form-control product_kind_id\">";
    for ($i = 0; $i < $cat_n; $i++) {
        $cat_selector.="<option value=\"$cat_ids[$i]\">$cat_names[$i]</option>";
    }
    $cat_selector.="</select>";
    
    $product_query = "SELECT * FROM products LIMIT $start,$limit";
    //$product_query = "SELECT * FROM products";
    $product_list = mysqli_query($con,$product_query);
    
    echo '<div class="container"><table class="table table-striped">
    <thead>
    <tr>
    <th>id</th>
    <th>picture</th>
    <th>category</th>
    <th>name</th>
    <th>keywords</th>
    <th>inventory</th>
    <th>price</th>
    <th>cost</th>
    </tr>
    <tr>
    <td>New</td>
    <td>
    <div class="img-container">
        <img class="picture" height="42" width="42" alt="select a picture" title="select a picture" src="images/0.png">
        <div class="img-centered">
            <label class="img-label" for="my-file-selector">
                <input class="image" id="my-file-selector" type="file" style="display:none;" accept="image/x-png,image/gif,image/jpeg">
            </label>
        </div>
    </div>
    </td>
    <td>
    '.$cat_selector.'
    </td>
    <td><input type="text" class="form-control name" value=""></td>
    <td><input type="text" class="form-control keywords" value=""></td>
    <td><input type="text" class="form-control inventory_amount" value=""></td>
    <td><input type="text" class="form-control price" value=""></td>
    <td><input type="text" class="form-control cost" value=""></td>
    <td>
    <a href="#" class="del-btn admin-p-add"><span class="glyphicon glyphicon-plus"> add</span></a>
    </td>
    </tr>
    
    ';
    if (mysqli_num_rows($product_list) > 0) {
        while ($row=mysqli_fetch_array($product_list)) {
            $product_id = $row["product_id"];
            $product_kind_id = $row["product_kind_id"];
            $name = $row["name"];
            $keywords = $row["keywords"];
            $image = $row["image"];
            $inventory_amount = $row["inventory_amount"];
            $price = $row["price"];
            $cost = $row["cost"];
            
            $cat_selector_this = str_replace("\"$product_kind_id\"","\"$product_kind_id\" selected",$cat_selector);
            
            echo '
            <tr>
            <td>'.$product_id.'</td>
            <td>
            <div class="img-container">
            <img class="picture" height="42" width="42" alt="select a picture" title="select a picture" src="images/'.$image.'"/>
            <div class="img-centered">
            <label class="img-label" for="my-file-selector'.$product_id.'">
                <input fn="'.$image.'" class="image" id="my-file-selector'.$product_id.'" type="file" style="display:none;" accept="image/x-png,image/gif,image/jpeg">
            </label>
            </div>
            </div>
            </td>
            <td>'.$cat_selector_this.'</td>
            <td><input type="text" class="form-control name" value="'.$name.'"></td>
            <td><input type="text" class="form-control keywords" value="'.$keywords.'"></td>
            <td><input type="text" class="form-control inventory_amount" value="'.$inventory_amount.'"></td>
            <td><input type="text" class="form-control price" value="'.$price.'"></td>
            <td><input type="text" class="form-control cost" value="'.$cost.'"></td>
            <td>
            <a href="#" remove_id="'.$product_id.'" class="del-btn admin-p-remove"><span class="glyphicon glyphicon-trash"></span></a>
            <a href="#" update_id="'.$product_id.'" class="del-btn admin-p-update"><span class="glyphicon glyphicon-refresh"></span></a>
            </td>
            </tr>
            ';
            
            
        }
    }
    echo '</table></div>';
}
    
if(isset($_POST["adminGetOrder"])){
    
    $limit = 10;
    if(isset($_POST["setAdminOrderPage"])){
        $pageno = $_POST["adminOrderPageNumber"];
        $start = ($pageno * $limit) - $limit;
    }else{
        $start = 0;
    }
    
    
    //$sql = "SELECT * from order_detail";
    $sql = "SELECT * from order_detail LIMIT $start,$limit";
    $order_list = mysqli_query($con,$sql);
    
    echo '<div class="container-fluid"><table class="table table-striped">
    <thead>
    <tr>
    <th>order_id</th>
    <th>product_id</th>
    <th>customer_id</th>
    <th>quantity</th>
    <th>store_id</th>
    <th>employee_id</th>
    <th>shipping_street</th>
    <th>city</th>
    <th>state</th>
    <th>zip</th>
    <th>time</th>
    </tr>
    
    ';
    if (mysqli_num_rows($order_list) > 0) {
        while ($row=mysqli_fetch_array($order_list)) {
            $order_detail_id = $row["order_detail_id"];
            $order_id = $row["o_id"];
            $product_id = $row["p_id"];
            $customer_id = $row["c_id"];
            $quantity = $row["qty"];
            $store_id = $row["store_id"];
            $employee_id = $row["employee_id"];
            $shipping_street = $row["shipping_st"];
            $city = $row["city"];
            $state = $row["state"];
            $zip = $row["zip"];
            $time = $row["time"];
            
            echo '
            <tr>
            <td>'.$order_id.'</td>
            <td><input type="text" class="form-control p_id" value="'.$product_id.'"></td>
            <td><input type="text" class="form-control c_id" value="'.$customer_id.'"></td>
            <td><input type="text" class="form-control qty" value="'.$quantity.'"></td>
            <td><input type="text" class="form-control store_id" value="'.$store_id.'"></td>
            <td><input type="text" class="form-control employee_id" value="'.$employee_id.'"></td>
            <td><input type="text" class="form-control shipping_st" value="'.$shipping_street.'"></td>
            <td><input type="text" class="form-control city" value="'.$city.'"></td>
            <td><input type="text" class="form-control state" value="'.$state.'"></td>
            <td><input type="text" class="form-control zip" value="'.$zip.'"></td>
            <td><input type="text" class="form-control time" value="'.$time.'"></td>
            <td>
            <a href="#" remove_id="'.$order_detail_id.'" class="del-btn admin-o-remove"><span class="glyphicon glyphicon-trash"></span></a>
            <a href="#" update_id="'.$order_detail_id.'" class="del-btn admin-o-update"><span class="glyphicon glyphicon-refresh"></span></a>
            </td>
            </tr>
            ';
            
            
        }
    }
    echo '</table></div>';
}
    
    
if(isset($_POST["adminGetCustomer"])){
    
    $limit = 10;
    if(isset($_POST["setAdminCustomerPage"])){
        $pageno = $_POST["adminCustomerPageNumber"];
        $start = ($pageno * $limit) - $limit;
    }else{
        $start = 0;
    }
    
    
    //$sql = "SELECT * from order_detail";
    $sql = "SELECT * from customers LIMIT $start,$limit";
    $customer_list = mysqli_query($con,$sql);
    
    echo '<div class="container-fluid admin"><table class="table table-striped">
    <thead>
    <tr>
    <th>id</th>
    <th>first_name</th>
    <th>last_name</th>
    <th>phone_number</th>
    <th>email_address</th>
    <th>street</th>
    <th>city</th>
    <th>state</th>
    <th>zip</th>
    <th>home/business</th>
    <th>business_category</th>
    <th>annual_income</th>
    <th>married</th>
    <th>gender</th>
    <th>birth_year</th>
    </tr>
    
    ';
    if (mysqli_num_rows($customer_list) > 0) {
        while ($row=mysqli_fetch_array($customer_list)) {
            $customer_id = $row["customer_id"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $phone_number = $row["phone_number"];
            $email = $row["email"];
            $street = $row["street"];
            $city = $row["city"];
            $state = $row["state"];
            $zip = $row["zip"];
            $home_or_business = $row["home_or_business"];
            $business_category = $row["business_category"];
            $annual_income = $row["annual_income"];
            $married = $row["married"];
            $gender = $row["gender"];
            $birth_year = $row["birth_year"];
            
            echo '
            <tr>
            <td>'.$customer_id.'</td>
            <td><input type="text" class="form-control first_name" value="'.$first_name.'"></td>
            <td><input type="text" class="form-control last_name" value="'.$last_name.'"></td>
            <td><input type="text" class="form-control phone_number" value="'.$phone_number.'"></td>
            <td><input type="text" class="form-control email" value="'.$email.'"></td>
            <td><input type="text" class="form-control street" value="'.$street.'"></td>
            <td><input type="text" class="form-control city" value="'.$city.'"></td>
            <td><input type="text" class="form-control state" value="'.$state.'"></td>
            <td><input type="text" class="form-control zip" value="'.$zip.'"></td>
            <td><input type="text" class="form-control home_or_business" value="'.$home_or_business.'"></td>
            <td><input type="text" class="form-control business_category" value="'.$business_category.'"></td>
            <td><input type="text" class="form-control annual_income" value="'.$annual_income.'"></td>
            <td><input type="text" class="form-control married" value="'.$married.'"></td>
            <td><input type="text" class="form-control gender" value="'.$gender.'"></td>
            <td><input type="text" class="form-control birth_year" value="'.$birth_year.'"></td>
            <td>
            <a href="#" remove_id="'.$customer_id.'" class="del-btn admin-c-remove"><span class="glyphicon glyphicon-trash"></span></a>
            <a href="#" update_id="'.$customer_id.'" class="del-btn admin-c-update"><span class="glyphicon glyphicon-refresh"></span></a>
            </td>
            </tr>
            ';
            
            
        }
    }
    echo '</table></div>';
}   
        
    
    

if(isset($_POST["addToCart"])){
    $p_id = $_POST["proId"];
    if(isset($_SESSION["uid"])){
        $c_id = $_SESSION["uid"];
        $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND c_id = '$c_id'";
    } else {
        $c_id = -1;
        $sql = "SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND c_id = -1";
    }
    $query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($query);
    
    // get product amount
    $product_query = "SELECT product_id,inventory_amount FROM products WHERE product_id = ".$p_id;
    $run_query = mysqli_query($con,$product_query);
    $row = mysqli_fetch_array($run_query);
    $pro_amount = $row['inventory_amount'];
    if($pro_amount==0) {
        echo "
        <div class='alert alert-danger'>
        Sorry, the product is temporarily out of stock.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>
        ";
        exit();
    }
    
    if($count == 0){
        $sql = "INSERT INTO `cart`
        (`p_id`, `ip_add`, `c_id`, `qty`)
        VALUES ('$p_id','$ip_add','$c_id','1')";
        if(mysqli_query($con,$sql)){
            echo "
            <div class='alert alert-success'>
            The product has been added to your cart.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        }
        exit();
    } else {
        // check prodcut amount
        $res = mysqli_fetch_array($query);
        $qty = $res['qty'];
        if($qty==$pro_amount){
            echo "
            <div class='alert alert-danger'>
            Insufficient stock! You cannot add this product to your cart.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
            exit();
        }
        
        if (isset($_SESSION["uid"])) {
            $sql = "UPDATE cart SET qty=qty+1 WHERE p_id = '$p_id' AND c_id = '$c_id'";
        }else{
            $sql = "UPDATE cart SET qty=qty+1 WHERE p_id = '$p_id' AND ip_add = '$ip_add' AND c_id = -1";
        }
        if(mysqli_query($con,$sql)){
            echo "
            <div class='alert alert-info'>
            The quantity in of the product in your cart has been updated.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
            exit();
        }
    }
}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT SUM(qty) AS count_item FROM cart WHERE c_id = $_SESSION[uid]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT SUM(qty) AS count_item FROM cart WHERE ip_add = '$ip_add' AND c_id < 0";
	}
	
	$query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.name,a.price,a.image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.c_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.name,a.price,a.image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.c_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
            $total=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$name = $row["name"];
				$price = $row["price"];
				$image = $row["image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
                $subtotal = $price * $qty;
                $total=$total+$subtotal;
				echo '
					<div class="row top-buffer">
						<div class="col-md-3"><img class="img-responsive" src="images/'.$image.'" /></div>
						<div class="col-md-6">'.$name.'</div>
						<div class="col-md-3">$'.$subtotal.'</div>
                        <div class="col-md-3">&times; '.$qty.'</div>
					</div>
                ';
				
			}
            echo '
            <div class="row top-buffer text-right"><hr>
            <div class="col-md-9">Total: $'.number_format($total,2).'</div>
            <div class="col-md-3"><button type="button" style="float:right;" class="btn btn-default" onclick="location.href=\'cart.php\'">Edit</span></button></div>
            </div>
            ';
			exit();
		}
    }

    if (isset($_POST["payment"])) {
        if (mysqli_num_rows($query) > 0) {
            $net_total=0;
            while ($row=mysqli_fetch_array($query)) {
                $price = $row["price"];
                $qty = $row["qty"];
                $subtotal = $price * $qty;
                $net_total = $net_total + $subtotal;
            }
            $tax = number_format($net_total*0.06,2);
            $total = number_format($net_total*1.06,2);
            echo "
                Subtotal: <span style='float:right;'>$$net_total</span><br>Shipping: <span style='float:right;'>Free</span><br>Est Tax: <span style='float:right;'>$$tax</span><hr> <b> Total: <span style='float:right;'>$$total</b></span>
            ";
        }
    }
    
    if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			//echo "<form method='post' action='login_form.php'>";
            echo '<div class="row"><div class="col-md-9" >';
				$n=0;
                $total=0;
                $product_list =[];
				while ($row=mysqli_fetch_array($query)) {
					$product_id = $row["product_id"];
					$name = $row["name"];
					$price = $row["price"];
					$image = $row["image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];
                    $subtotal = number_format($price * $qty,2);
                    //$total = $total + $subtotal;
                    $product_list[] = $product_id;
                    $n++;
					echo 
                    '
                            <div class="row top-buffer">
                                <input type="hidden" class="form-control pid" value="'.$product_id.'">
                                <input type="hidden" class="form-control price" value="'.$price.'">
                                <input type="hidden" class="form-control total" value="'.$subtotal.'">
                                <div class="col-md-3"><img class="img-responsive" src="images/'.$image.'"></div>
                                <div class="col-md-3">'.$name.'</div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-3">Qty.
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control qty" value="'.$qty.'" >
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#" remove_id="'.$product_id.'" class="del-btn  remove"><span class="glyphicon glyphicon-trash"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b class="sub_total" style="font-size:14px;"></b>
                                    <h4 style="color:#bbb;font-size=8px !important;" class="single_price"></h4>
                                </div>
							</div>
                    ';
				}
            
                //here we are converting array into json format because array cannot be store in cookie
                $json_e = json_encode($product_list);
                //here we are creating cookie and name of cookie is product_list
                if (!headers_sent()) {
                setcookie("product_list","",strtotime("-1 day"),"/");
                setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);
                }
                echo '
                    </div><div "col-md-3"><div class="net_total" style="font-size:16px;"></div><br>
                ';
            
				if (!isset($_SESSION["uid"])) {
                    
                    echo '
                    <span style="float:right;"><button class="check-btn" data-toggle="modal" data-target="#myModal">Check Out</button></span></div>
                    ';
					
				} else if(isset($_SESSION["uid"])){
                    echo '
                    <span style="float:right;"><button class="check-btn" onclick="location.href=\'checkout.php\'">Check Out</button></span></div>
                    ';
				}
			}
	}
	
	
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND c_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "
        <div class='alert alert-danger'>
        The product is removed from cart.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>
        ";
		exit();
	}
}

if (isset($_POST["adminRemoveProduct"])) {
    $remove_id = $_POST["rid"];
    $sql = "DELETE FROM products WHERE product_id = '$remove_id'";
    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-danger'>
            The product $remove_id is removed.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    }
}

if (isset($_POST["adminRemoveOrderDetail"])) {
    $remove_id = $_POST["rid"];
    $sql = "DELETE FROM order_detail WHERE order_detail_id = '$remove_id'";
    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-danger'>
            The order detail# $remove_id is removed.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    }
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND c_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "
        <div class='alert alert-info'>
        The quantity of the product is updated.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>
        ";
		exit();
	}
}

if (isset($_POST["adminUpdateProduct"])) {
    $update_id = $_POST["update_id"];
    $product_kind_id = $_POST["product_kind_id"];
    $name = $_POST["name"];
    $keywords = $_POST["keywords"];
    $image = $_POST["image"];
    $inventory_amount = $_POST["inventory_amount"];
    $price = $_POST["price"];
    $cost = $_POST["cost"];
    
    $sql = "UPDATE products SET product_kind_id='$product_kind_id', name='$name', keywords='$keywords', image='$image', inventory_amount='$inventory_amount', price='$price', cost='$cost' WHERE product_id = '$update_id'";

    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-info'>
            The product is updated.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    } else {
        echo $sql;
    }
}

if (isset($_POST["adminUpdateOrderDetail"])) {
    $update_id = $_POST["update_id"];
    $p_id = $_POST["p_id"];
    $c_id = $_POST["c_id"];
    $qty = $_POST["qty"];
    $store_id = $_POST["store_id"];
    $employee_id = $_POST["employee_id"];
    $shipping_st = $_POST["shipping_st"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    
    $sql = "UPDATE order_detail SET p_id='$p_id', c_id='$c_id', qty='$qty', store_id='$store_id', employee_id='$employee_id', shipping_st='$shipping_st', city='$city', state='$state', zip='$zip' WHERE order_detail_id = '$update_id'";

    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-info'>
            The order detail is updated.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    } else {
        echo $sql;
    }
}

if (isset($_POST["adminAddProduct"])) {
        $product_kind_id = $_POST["product_kind_id"];
        $name = $_POST["name"];
        $keywords = $_POST["keywords"];
        $image = $_POST["image"];
        $inventory_amount = $_POST["inventory_amount"];
        $price = $_POST["price"];
        $cost = $_POST["cost"];
    
        $sql = "INSERT INTO products (`product_id`, `product_kind_id`, `name`, `keywords`, `image`, `inventory_amount`, `price`, `cost`) VALUES (NULL, '$product_kind_id', '$name', '$keywords', '$image', '$inventory_amount', '$price', '$cost')";
        
        if(mysqli_query($con,$sql)){
            echo "
            <div class='alert alert-success'>
            The product is added.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
            exit();
        } else {
            echo $sql;
        }
}


if (isset($_POST["adminRemoveCustomer"])) {
    $remove_id = $_POST["rid"];
    $sql = "DELETE FROM customers WHERE customer_id = '$remove_id'";
    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-danger'>
            The customer ID# $remove_id is removed.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    }
}

if (isset($_POST["adminUpdateCustomer"])) {
    $update_id = $_POST["update_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $home_or_business = $_POST["home_or_business"];
    $business_category = $_POST["business_category"];
    $annual_income = $_POST["annual_income"];
    $married = $_POST["married"];
    $gender = $_POST["gender"];
    $birth_year = $_POST["birth_year"];
    
    $sql = "UPDATE customers SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', email='$email', street='$street', city='$city', state='$state', zip='$zip', home_or_business='$home_or_business', business_category='$business_category', annual_income='$annual_income', married='$married', gender='$gender', birth_year='$birth_year' WHERE customer_id = '$update_id'";

    if(mysqli_query($con,$sql)){
        echo "
            <div class='alert alert-info'>
            The customer detail is updated.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='color:black !important'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>
            ";
        exit();
    } else {
        echo $sql;
    }
}


?>






