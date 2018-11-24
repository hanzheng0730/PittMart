<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>

<?php
    include('header.php');
?>

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
<span class="sr-only">navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" rel="home" href="#">
PITTMART
</a>
</div>
<div class="collapse navbar-collapse" id="collapse">
<ul class="nav navbar-nav">
<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["name"]; ?></a>
<ul class="dropdown-menu">
<li><a href="customer_order.php">My Orders</a></li>
<li><a href="">My Account</a></li>
<li><a href="logout.php">Sign Out</a></li>
</ul>
</li>
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> CART <span class="badge" style="font:sans-serif;">0</span></a>
<div class="dropdown-menu scrollable-menu" role="menu">
<div class="container" style="width:450px;color:black !important;">
<div id="cart_product"></div>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<p><br/></p>
<p><br/></p>

	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
						<h1>Your Orders</h1>
						<?php
							include_once("db.php");
							$user_id = $_SESSION["uid"];
							$orders_list = "SELECT o.o_id,o.c_id,o.p_id,o.qty,o.time,p.name,p.price,p.image FROM order_detail o,products p WHERE o.c_id='$user_id' AND o.p_id=p.product_id";
							$query = mysqli_query($con,$orders_list);
							if (mysqli_num_rows($query) > 0) {
                                $current = -1;
                                

								while ($row=mysqli_fetch_array($query)) {
                                    $o_id = $row["o_id"];
                                    $time = $row["time"];
                                    if ($o_id != $current){
                                        $current = $o_id;
                                        echo '<hr><div class ="row"><div class="col-md-6"><b>Order Number: </td><td>'.$o_id.'</b><br><span style="color:#777;font-size:12px">'.$time.'</span></div><div class="col-md-6"></div></div>
                                        ';
                                    }
									?>

										<div class="row">
											<div class="col-md-5">
                                            <img style="float:right;weight:150px;height:100px" src="images/<?php echo $row['image']; ?>" class="img-responsive"/>
											</div>
											<div class="col-md-4">
												<table>
                                                    <tr><td>Name: </td><td><?php echo $row["name"]; ?> </td></tr>
                                                    <tr><td>Price: </td><td><?php echo "$ ".$row["price"]; ?></td></tr>
                                                    <tr><td>Qty.: </td><td><?php echo $row["qty"]; ?></td></tr>
												</table>
											</div>
                                            <div class="col-md-3"></div>
										</div>
									<?php
								}
							}
						?>
			</div>
			<div class="col-md-2"></div>
		</div>
        <br><br>
	</div>

<?php
    include('footer.php');
?>
















































