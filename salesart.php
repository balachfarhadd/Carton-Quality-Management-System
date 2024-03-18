
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
  $query="  SELECT
    pc.catagory_name,
    SUM(p.stockQuantity) as Quantity
  FROM
    product p
  JOIN product_categori pc ON p.catagori_id = pc.catagori_id
  GROUP BY pc.catagory_name";
  $res=mysqli_query($conn,$query);
  $test4=array();
  $count=0;
  while($row=mysqli_fetch_array($res)){
     $test4[$count]["label"]=$row["catagory_name"];
     $test4[$count]["y"]=$row["Quantity"];
     $count=$count+1;
 
  }
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username'] ?>Inventory Forcasting</title>
    <link rel="stylesheet" href="wellcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chart", {
	animationEnabled: true,
	theme: "light1",
	title:{
		text: "Inventory Forecasting"
	},
	axisY: {
		title: "Number of Quantity (in Numbers)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Quantity",
		dataPoints: <?php echo json_encode($test4, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
    
</head>
<body>
    
        \
                <div id="chart" style="height: 500px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    
                    
            


            

    
</body>
</html>