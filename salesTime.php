<?php
 
$dataPoints = array(
	array("label"=> "Education", "y"=> 284935),
	array("label"=> "Entertainment", "y"=> 256548),
	array("label"=> "Lifestyle", "y"=> 245214),
	array("label"=> "Business", "y"=> 233464),
	array("label"=> "Music & Audio", "y"=> 200285),
	array("label"=> "Personalization", "y"=> 194422),
	array("label"=> "Tools", "y"=> 180337),
	array("label"=> "Books & Reference", "y"=> 172340),
	array("label"=> "Travel & Local", "y"=> 118187),
	array("label"=> "Puzzle", "y"=> 107530)
);
include "dbconnected.php";
$query=" SELECT o.order_quantity AS PurchaseCost, pc.catagory_name AS Category
FROM ordrs o
JOIN product pr ON o.product_id = pr.product_id
JOIN product_categori pc ON pr.catagori_id = pc.catagori_id";

$res=mysqli_query($conn,$query);
$test2=array();
$count=0;
while($row=mysqli_fetch_array($res)){
   $test2[$count]["label"]=$row["Category"];
   $test2[$count]["y"]=$row["PurchaseCost"];
   $count=$count+1;

}	
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chart", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Total Sales "
	},
	axisY: {
		title: "Quantith Sold"
	},
  
	data: [{
		type: "bar",
		dataPoints: <?php echo json_encode($test2, JSON_NUMERIC_CHECK); ?>
    
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
