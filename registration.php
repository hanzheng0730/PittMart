<?php
if (isset($_GET["register"])) {

    include('header.php');
?>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
                <a class="navbar-brand" rel="home" href="#">
                PITTMART
                </a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-3"></div>
		</div>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
                <div class="panel panel-primary" style="padding:20px">
					<div class="panel-heading"><h3>Creat a new account<h3></div>
					<div class="panel-body">
					
					<form id="signup_form" onsubmit="return false">
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
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone"class="form-control">
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
								<label for="password">Password</label>
								<input type="password" id="password" name="password"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Re-enter Password</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="street">Street Address</label>
								<input type="text" id="street" name="street"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label for="city">City</label>
								<input type="text" id="city" name="city"class="form-control">
							</div>
                            <div class="col-md-4">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state"class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip"class="form-control">
                            </div>
						</div>

                        <hr>
                        <center><p style="font-size:18px">Optional</p></center>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                <option value="NULL">--</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                                <option value="Other">Others</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="m_status">Marital Status</label>
                                <select class="form-control" id="m_status" name="m_status">
                                <option value="NULL">--</option>
                                <option value="No">Single</option>
                                <option value="Yes">Married</option>
                                <option value="Other">Others</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="b_year">Year of Birth</label>
                                <input type="text" id="b_year" name="b_year" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="home_business"> </label><br>

                                <label class="radio-inline"><input type="radio" name="home_business" onclick="javascript:hbCheck();" id="h_checked" value="home" checked>Home</label>
                                <label class="radio-inline"><input type="radio" onclick="javascript:hbCheck();" id="b_checked" name="home_business" value="business">Business</label>
                                <script>
                                        function hbCheck() {
                                                if (document.getElementById('b_checked').checked) {
                                                    document.getElementById('ifBusienss').style.visibility = 'visible';
                                                }
                                                else document.getElementById('ifBusienss').style.visibility = 'hidden';
                                        }
                                </script>
                            </div>
                            <div class="col-md-6">
                                <div id="ifBusienss" style="visibility:hidden">
                                    <label for="business_cat">Businesss Catogery</label>
                                        <select class="form-control" id="business_cat" name="business_cat">
                                        <option value="NULL">--</option>
                                        <option value="IT">IT</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Restaurant">Restaurant</option>
                                        <option value="Education">Education</option>
                                        <option value="Other">Others</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="income">Annual Income</label>
                                <input type="text" id="income" name="income"class="form-control">
                            </div>
                        </div>


						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input style="width:100%;" value="Sign Up" type="submit" name="signup_button" class="check-btn">
							</div>
						</div>
						
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>



<?php
    include('footer.php');
    }
?>
