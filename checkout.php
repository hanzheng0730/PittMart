<?php


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
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> CART <span class="badge">0</span></a>
                <div class="dropdown-menu scrollable-menu" role="menu">
                <div class="container" style="width:450px;color:black !important;">
                <div class="product_list">
                <div id="cart_product"></div>
                </div>
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
            <div class="col-md-3"></div>
            <div class="col-md-6" id="checkout_msg">
            <!--Alert from signup form-->
            </div>
            <div class="col-md-3"></div>
        </div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-4">
                <h3>CHECKOUT</h3>
                <hr>

                <form id="checkout_form" onsubmit="return false">
                    <p>Shipping Address</p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="f_name">First Name</label>
                            <input type="text" id="f_name" name="f_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="f_name">Last Name</label>
                            <input type="text" id="l_name" name="l_name"class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="mobile">Mobile</label>
                            <input type="text" id="mobile" name="mobile"class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="zip">Zip Code</label>
                            <input type="text" id="zip" name="zip" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control">
                        </div>
                    </div>
<hr>
<p>Card Information</p>

<div class="row">
    <div class="col-md-12">
        <label for="card_name">Name on card</label>
        <input type="text" id="card_name" name="card_name" class="form-control">
    </div>
</div>

<div class="row">
<div class="col-md-12">
<label for="card_number">Card number</label>
<input type="text" id="card_number" name="card_number" class="form-control">
<div class="form-group" id="credit_cards">
<img src="images/visa.jpg" width="30px" id="visa">
<img src="images/mastercard.jpg" width="30px" id="mastercard">
<img src="images/amex.jpg" width="30px" id="amex">
</div>

</div>
</div>

<div class="row">
<div class="col-md-6">
<label for="card_date">Expiration date</label>

<div class="form-group" id="card-date">
<select>
<option value="01">January</option>
<option value="02">February </option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select>
<option value="16"> 2018</option>
<option value="17"> 2019</option>
<option value="18"> 2020</option>
<option value="19"> 2021</option>
<option value="20"> 2022</option>
<option value="21"> 2023</option>
</select>
</div>

</div>
<div class="col-md-3">
<label for="card_code">Security code</label>
<input type="text" id="card_code" name="card_code" class="form-control">
</div>
<div class="col-md-3">
<label for="card_zip">Zip code</label>
<input type="text" id="card_zip" name="card_zip" class="form-control">
</div>
</div>


                    <hr>

<div id="payment"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <input style="width:100%;" value="Place Order" type="submit" name="checkout_button" class="check-btn">
                        </div>
                    </div>

                </form>
            </div>
			<div class="col-md-6"></div>
        </div>
    </div>


<?php
    include('footer.php');
?>














		
