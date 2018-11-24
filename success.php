<?php

session_start();
include "db.php";
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
<img style="max-width:50px; margin-top: -7px;" src="images/logo.png">PITTMART
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
<p><br/></p>

<div class="container-fluid" style="color:black !important;">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php
    
    $trx_id = $_SESSION["trx_id"];
    $employee_id = $_SESSION["employee_id"];
    $sql = "SELECT * FROM employees as e,stores as s WHERE e.employee_id = '$employee_id' AND e.store_id = s.store_id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone = $row["phone_number"];
    $street = $row["street"];
    $city = $row["city"];
    $state = $row["state"];
    $zip = $row["zip"];
    
    echo "<h3>You are all set! Your order number is: $trx_id</h3>
        <p>If you have any question regarding your order, please contact the sales person below.</p>
        <p style='font-size:20px;'><b>$first_name $last_name</b></p>
        <p><span class='glyphicon glyphicon-phone-alt'></span>  $phone</p>
        <p><span class='glyphicon glyphicon-envelope'></span> $email</p>
        <p><b>Store Address:</b></p>
        <p id='address'>$street, $city, $state $zip</p>
    ";
    $lat = 40.544020;
    $lng = -80.018360;

?>



<div id="googleMap1" style="width:100%;height:400px;"></div>

<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('googleMap1'), {
                                  zoom: 12,
                                  center: {lat: 40.544020, lng: -80.018360}
                                  });
    var geocoder = new google.maps.Geocoder();
    
    geocodeAddress(geocoder, map);
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').innerHTML;
    //console.log(document.getElementById('address').innerHTML);
    geocoder.geocode({'address': address}, function(results, status) {
                     if (status === 'OK') {
                     resultsMap.setCenter(results[0].geometry.location);
                     var marker = new google.maps.Marker({
                                                         map: resultsMap,
                                                         position: results[0].geometry.location
                                                         });
                     } else {
                     alert('Geocode was not successful for the following reason: ' + status);
                     }
                     });
}
</script>

</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMZSP7I-1TVzknC7-qfExu40JRMozaGnE&callback=initMap">
</script>




</div>
<div class="col-md-3"></div>
</div>
<br>
<br>
<?php
    include('footer.php');
?>


