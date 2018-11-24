
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
		</div>
	</div>
	</div>
	<p><br><br></p>






	<div class="container-fluid" style="color:black !important;">

<?php
    $pass = $_POST['pass'];
    
    if($pass == "admin")
    {
        include("dashboard.php");
    }
    else
    {
        if(isset($_POST))
        {?>
    <p></p>
    <p><br/></p>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-3">
<form method="POST" action="admin.php">
<div class="input-group">
<input type="password" class="form-control" name="pass" placeholder="Enter admin password" required/>
<div class="input-group-btn">
<button type="submit" class="btn btn-default">Enter</button>
</div>
</div>
</form>
</div>
<div class="col-md-6"></div>
</div>
<?}
}
?>

<br>
<br>

<?php
    include('footer.php');
?>














		
