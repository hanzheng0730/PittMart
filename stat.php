<?php
    // pie
    
    $sql = "select k.product_kind_name as cat, sum(o.qty) as total_sold from products p, order_detail o, product_kinds k where p.product_id=o.p_id and p.product_kind_id=k.product_kind_id group by k.product_kind_name";
    
    $result = $con->query($sql);
    
    $pie_p_labels = "";
    $pie_p_profit = "";
    while($row = $result->fetch_assoc())
    {
        $pie_p_labels.= "'".$row["cat"]."', ";
        $pie_p_profit.= "'".$row["total_sold"]."', ";
        
    }
    
    $sql = "select c.business_category as cat, sum(o.qty) as total_sold from customers c, order_detail o where c.customer_id=o.c_id group by c.business_category order by total_sold ";
    
    $result = $con->query($sql);
    
    $pie_b_labels = "";
    $pie_b_profit = "";
    while($row = $result->fetch_assoc())
    {
        $cat = $row["cat"];
        if($cat!="NULL"){
            $pie_b_labels.= "'".$cat."', ";
            $pie_b_profit.= "'".$row["total_sold"]."', ";
        }
    }
    
    
    // best seller
    $sql = "select p.name, p.price, p.cost, sum(o.qty) as total_sold from products p join order_detail o on p.product_id=o.p_id group by o.p_id order by total_sold DESC limit 10";
    
    $result = $con->query($sql);
    
    $best_seller_labels = "";
    $best_seller_data = "";
    $best_seller_profit = "";
    while($row = $result->fetch_assoc())
    {
        $profit = ($row["price"] - $row["cost"] ) * $row["total_sold"];
        $best_seller_labels.= "'".$row["name"]."', ";
        $best_seller_data.= $row["total_sold"].", ";
        $best_seller_profit.= number_format($profit,2,".","").", ";
        
    }
    
    // profit
    
    $sql = "select sum(p.price * o.qty) as revenue, sum((p.price - p.cost) * o.qty) as profit, month(o.time) as mon from products p join order_detail o on p.product_id=o.p_id group by mon";
    
    $result = $con->query($sql);
    
    $revenue_data = "";
    $profit_data = "";
    while($row = $result->fetch_assoc())
    {
        $revenue_data.= "'".$row["revenue"]."', ";
        $profit_data.= $row["profit"].", ";
    }
   
    // stores
    
    $sql = "select sum(o.qty * p.price) as revenue, sum((p.price - p.cost) * o.qty) as profit, o.store_id as id from order_detail o join products p on o.p_id = p.product_id group by o.store_id order by profit desc limit 10";
    
    $result = $con->query($sql);
    
    $store_labels = "";
    $store_revenue_data = "";
    $store_profit_data = "";
    while($row = $result->fetch_assoc())
    {
        $store_revenue_data.= "'".$row["revenue"]."', ";
        $store_labels.= "'Store#".$row["id"]."', ";
        $store_profit_data.= $row["profit"].", ";
    }
    
    ?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div style="width:90%">
            <canvas id="pie"></canvas><br>
            <center>
            <button class="check-btn" id="pie-p-cat">Product Category</button>
            <button class="check-btn" id="pie-b-cat">Business Category</button>
            </center>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div>
            <canvas id="profits"></canvas>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div>
            <canvas id="bestseller"></canvas>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<hr>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div><div style="position: absolute;left:6px;top: 58px;"><img width="20px" src="images/crown.png"></div>
<canvas id="beststore"></canvas>
</div>
</div>
<div class="col-md-3"></div>
</div>

<script>




// pie


var pieConfig = {
type: 'pie',
data: {
    datasets: [{
        data: [<?php echo $pie_p_profit ?>],
        backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow,
            window.chartColors.green,
            window.chartColors.blue,
        ],
        label: 'Sales'
    }],
    labels: [<?php echo $pie_p_labels ?>],
},
options: {
    responsive: true
}
};

var pie = document.getElementById('pie').getContext('2d');
var pieChart = new Chart(pie, pieConfig);


document.getElementById('pie-p-cat').addEventListener('click', function() {
    pieConfig.data.datasets.forEach(function(dataset) {
        dataset.data = [<?php echo $pie_p_profit ?>];
    });
    pieConfig.data.labels = [<?php echo $pie_p_labels ?>];
    pieChart.update();
});

document.getElementById('pie-b-cat').addEventListener('click', function() {
    pieConfig.data.datasets.forEach(function(dataset) {
        dataset.data = [<?php echo $pie_b_profit ?>];
    });
    pieConfig.data.labels = [<?php echo $pie_b_labels ?>];
    pieChart.update();
});

//

var profitsPlot = document.getElementById("profits").getContext('2d');

var profitConfig = {
type: 'line',
data: {
labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
datasets: [{
label: 'Revenue',
backgroundColor: window.chartColors.blue,
borderColor: window.chartColors.blue,
data: [<?php echo $revenue_data ?>],
fill: false,
}, {
label: 'Gross Profit',
fill: false,
backgroundColor: window.chartColors.green,
borderColor: window.chartColors.green,
data: [<?php echo $profit_data ?>],
}]
},
options: {
responsive: true,
title: {
display: true,
text: 'Monthly Revenue and Gross Profit'
},
tooltips: {
mode: 'index',
intersect: false,
},
hover: {
mode: 'nearest',
intersect: true
},
scales: {
xAxes: [{
display: true,
scaleLabel: {
display: true,
labelString: 'Month'
}
}],
yAxes: [{
display: true,
scaleLabel: {
display: true,
labelString: 'USD'
}
}]
}
}
};

var profitsChart = new Chart(profitsPlot, profitConfig);

// best sellers

var color = Chart.helpers.color;
var bestsellerConfig = {
    type: 'horizontalBar',
    data: {
        
        labels: [<?php echo $best_seller_labels ?>],
        datasets: [{
        label: 'Sale Volume',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [<?php echo $best_seller_data ?>],
        }, {
        label: 'Gross Profit',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [<?php echo $best_seller_profit ?>],
        }]
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Best Sellers'
        }
    }
};
    

var bestsellerBar = document.getElementById('bestseller').getContext('2d');
var besetsellerChart = new Chart(bestsellerBar, bestsellerConfig);


// best stores

var beststoreConfig = {
type: 'horizontalBar',
data: {
    
labels: [<?php echo $store_labels ?>],
datasets: [{
label: 'Revenue',
backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
borderColor: window.chartColors.yellow,
borderWidth: 1,
data: [<?php echo $store_revenue_data ?>],
}, {
label: 'Gross Profit',
backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
borderColor: window.chartColors.green,
borderWidth: 1,
data: [<?php echo $store_profit_data ?>],
}]
},
options: {
responsive: true,
legend: {
position: 'top',
},
title: {
display: true,
text: 'Best Stores'
}
}
};


var beststoreBar = document.getElementById('beststore').getContext('2d');
var besetstoreChart = new Chart(beststoreBar, beststoreConfig);



</script>




















































