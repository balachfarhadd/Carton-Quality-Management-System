
<?php
 
 $dataPoints = array( 
     array("y" => 3373.64, "label" => "Germany" ),
     array("y" => 2435.94, "label" => "France" ),
     array("y" => 1842.55, "label" => "China" ),
     array("y" => 1828.55, "label" => "Russia" ),
     array("y" => 1039.99, "label" => "Switzerland" ),
     array("y" => 765.215, "label" => "Japan" ),
     array("y" => 612.453, "label" => "Netherlands" )
 );
  include "dbconnected.php";
  $query=" SELECT 
  pc.catagory_name,
  SUM(o.order_quantity) AS TotalPurchaseStock
FROM 
  ordrs o
JOIN 
  Product pr ON o.product_id = pr.product_id
JOIN 
  product_categori pc ON pr.catagori_id = pc.catagori_id
GROUP BY 
  pc.catagory_name";

  $res=mysqli_query($conn,$query);
  $test=array();
  $count=0;
  while($row=mysqli_fetch_array($res)){
     $test[$count]["label"]=$row["catagory_name"];
     $test[$count]["y"]=$row["TotalPurchaseStock"];
     $count=$count+1;
 
  }
  
  ?>
  <!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chart", {
	animationEnabled: true,
	theme: "light1",
	title:{
		text: "Demand Forecasting"
	},
	axisY: {
		title: "Number of Quantity (in numbers)"
	},
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.## Quantity",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
    
</head>
<body>
<div id="chart" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html> 
<!-- 
<!DOCTYPE html>
<html>
<head>
  <title>CanvasJS Chart</title>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
  <div id="chartContainer" style="height: 370px; width: 100%;"></div>

  <script>
    window.onload = function () {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "<?php echo $_SERVER['PHP_SELF']; ?>?action=fetch_data", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var data = JSON.parse(xhr.responseText);
          var chartData = [];
          for (var i = 0; i < data.length; i++) {
            chartData.push({ x: new Date(data[i].SaleTimestamp), y: parseInt(data[i].PurchaseQuantity) });
          }
          var chart = new CanvasJS.Chart("chartContainer", {
            title: {
              text: "Sales and Purchase Quantity Over Time"
            },
            axisX: {
              title: "Timestamp",
              valueFormatString: "DD MMM YYYY"
            },
            axisY: {
              title: "Purchase Quantity"
            },
            data: [{
              type: "line",
              dataPoints: chartData
            }]
          });
          chart.render();
        }
      };
      xhr.send();
    }
  </script>

  <?php
  if(isset($_GET['action']) && $_GET['action'] == 'fetch_data') {
    // Database connection
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from database
    $sql = "SELECT PurchaseQuantity, SaleTimestamp FROM YourTableName";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }

    // Return JSON response
    echo json_encode($data);

    // Close database connection
    $conn->close();

    exit; // Terminate further execution
  }
  ?>
</body>
</html> -->
