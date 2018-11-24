<?php
session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
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
				<li><a href="admin.php"><span class="glyphicon glyphicon-cog"></span> ADMIN </a></li>
			</ul>
			<form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" size="50" class="form-control" placeholder="Search" id="search">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default search-btn" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
		     </form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> ACCOUNT</a>
					<ul class="dropdown-menu">
                                <div class="container" style="width:350px;font-size:12px;letter-spacing:1px;">
                                <form onsubmit="return false" id="login">
										<label for="email">EMAIL</label>
										<input type="email" class="form-control" name="email" id="email" required/>
										<label for="email">PASSWORD</label>
										<input type="password" class="form-control" name="password" id="password" required/>
                                        <br>
                                        <button type="button" class="btn btn-default" onclick="location.href='registration.php?register=1'">Create a new account</button>
										<button type="submit" class="btn btn-default" style="float:right;">Sign in</button>
                                </form>
								<div id="e_msg"></div>
						</div>
					</ul>
				</li>
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
			<div class="col-md-1"></div>
			<div class="col-md-2 col-xs-12">
				<div id="get_category"></div>
			</div>
			<div class="col-md-8 col-xs-12">
                <div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg"></div>
				</div>
                <h3>PRODUCTS</h3>
                <div id="get_product"></div>
			</div>
			<div class="col-md-1"></div>
		</div>
        <div class="row">
            <div class="col-md-12">
                <center>
                <ul class="pagination pagination-sm" id="pageno">
                    <li><a href="#">1</a></li>
                </ul>
                </center>
            </div>
        </div>
	</div>

<?php
    include('footer.php');
?>

















































