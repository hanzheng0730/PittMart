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
                    <img style="max-width:50px; margin-top: -7px;" src="images/logo.png">PITTMART
                </a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid" style="color:black !important;">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
                <h3>YOUR CART</h3>
                <div id="cart_checkout"></div>
            </div>
			<div class="col-md-2"></div>
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h2>CUSTOMER SIGN IN</h2>
    </div>
    <div class="modal-body">
        <form onsubmit="return false" id="login">
        <div class="form-group">
            <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required/>
            <label for="email"><span class="glyphicon glyphicon-lock"></span> Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required/>
        </div>
        <a href="registration.php?register=1">Create a new account</a>
        <span style="float:right;"><button type="submit" class="check-btn">Sign in</button></span>
        </form>
    </div>
    <div class="modal-footer">

        <div id="e_msg"></div>
    </div>
</div>
</div>
</div>
<br><br>
<?php
    include('footer.php');
?>














		
