<?php
    include_once("db.php");
?>

<!-- <h3 class="text-center">Dashboard</h3>
-->

<div class="row">
<div class="col-md-12 col-xs-12" id="admin_msg"></div>
</div>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Products</a></li>
    <li><a data-toggle="tab" href="#menu1">Customers</a></li>
    <li><a data-toggle="tab" href="#menu2">Orders</a></li>
    <li><a data-toggle="tab" href="#menu3">Statistics</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h2>Products</h2>
        <div id="admin_get_product"></div>

        <center>
            <ul class="pagination pagination-sm" id="adminppageno">
                <li><a href="#">1</a></li>
            </ul>
        </center>

    </div>

    <div id="menu1" class="tab-pane fade">
        <h2>Customers</h2>
        <div id="admin_get_customer"></div>
        <center>
            <ul class="pagination pagination-sm" id="admincpageno">
                <li><a href="#">1</a></li>
            </ul>
        </center>
    </div>

    <div id="menu2" class="tab-pane fade">
        <h2>Orders</h2>
        <div id="admin_get_order"></div>

        <center>
            <ul class="pagination pagination-sm" id="adminopageno">
                <li><a href="#">1</a></li>
            </ul>
        </center>

    </div>

    <div id="menu3" class="tab-pane fade">
        <h2>Statistics</h2>
    <div id="admin_statistics">
        <?php
            include("stat.php");
        ?>
    </div>
</div>

</div>





















































