<?php
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true ){
 header("location: login.php");
 exit;
}
  
?>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username'] ?> Demand Forceasting</title>
    <link rel="stylesheet" href="wellcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1",
	title:{
		text: "Demand Forecasting"
	},
	axisY: {
		title: "Number of Quantity (in numbers)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Quantity",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
    
</head>
<body>
    <div class="container1">
        <div class="left">
            <i class="fa-sharp fa-solid fa-bars"></i>
        </div>
        <div class="right">
            <i class="fa-solid fa-magnifying-glass" id="ii"></i>
            <i class="fa-solid fa-bell" id="io" ></i>
            <a href="/Ali/login.php"  id="lo"><span id="logout">Logout</span><i class="fa fa-sign-out" aria-hidden="true" id="log"></i></a>


        </div>
    </div>
    <div class="parent">
        <div class="child1">
        <a href="/Ali/welcome.php"><button class="butn"><i id="icon" class="fa-solid fa-house"></i><h4 class="text1">Dashboard</h4></button></a>
             <a href="/Ali/productMeasurment.php"><button class="butn"><i id="icon" class="fa-brands fa-product-hunt"></i><h4 class="text1">Product Measurment</h4></button></a>

             <a href="/Ali/product.php"><button class="butn"><i id="icon" class="fa-brands fa-product-hunt"></i><h4 class="text1">Product</h4></button></a>
             <a href="/Ali/inventori.php"><button class="butn"><i id="icon" class="fa-solid fa-store"></i> <h4 class="text1">Inventory Managment</h4></button></a>
             <a href="/Ali/inventoryforecast.php"><button class="butn"><i  id="icon" class="fa-solid fa-store"></i><h4 class="text1">Inventory Forecast  </h4></button></a>
             <a href="/Ali/order.php"><button class="butn"><i id="icon" class="fa-solid fa-book"></i><h4 class="text1">Order</h4></button></a>
             <a href="/Ali/demandForecasting.php"><button class="butn"><i id="icon" class="fa-solid fa-book"></i><h4 class="text1">Demand Forecasting</h4></button></a>


             <a href="/Ali/sales.php"><button class="butn"><i id="icon" class="fa-brands fa-salesforce"></i><h4 class="text1">Sales</h4></button></a>
             <a href="/Ali/VendorInformation.php"><button class="butn"><i id="icon" class=" fa-solid fa-user"></i><h4 class="text1">Vendor Infromation</h4></button>

        </div>
        
        <div class="child2  my-0   py-4  px-5"  >

    
           <div class="container-fluid  ">
                
           <div class="alert alert-primary" role="alert"  >
         
                <h4 class="alert-heading">Demand Forecasting<h1><?php echo $_SESSION['username'] ?></h1></h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to exit this page and want to logout the press this link <a href="/Ali/logout.php">Logout</a></p>
              </div>

           </div>
           <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                </div>
               <div class="col-md-12    mt-5">
                        <h1   class="text-center">Details  Purchases  Stock </h1>
               </div>
                    <div class="col-md-4">
                        <h3  class="text-center  mt-5">Total Stocks</h3>
                    </div>
                    <div class="col-md-1  mt-5">

                    </div>
                    <div class="col-md-7 mt-5">
                        <h3   class="text-center">Single Stock</h3>
                    </div>
                
                
                <div class="col-md-4  ">
                <table class="table  my-1"  id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">catagory_name</th>
                        <th scope="col">PurchaseStock</th>
                       </tr>
                    </thead>
                    <tbody>
                    </tr>
  
  <?php
        $sql="SELECT 
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
        $serial=0;
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $serial=$serial +1;
        echo'  <tr>
        <th scope="row">'. $serial . '</th>
        <td>'. $row['catagory_name']  .'</td>
        <td>'. $row['TotalPurchaseStock']  .'</td>
       
        </tr>';
          
        }

    ?>

    </tbody>
</table>
                </div>
                <div class="col-md-1   ">

                </div>
                <div class="col-md-7   ">
                <table class="table  my-1"  id="myTable1">
                    <thead>
                        <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">catagory_name</th>
                        <th scope="col">PurchaseStock</th>
                       </tr>
                    </thead>
                    <tbody>
                    </tr>
  
  <?php
        $sql="SELECT 
        pc.catagory_name,
        o.order_quantity
    FROM 
        ordrs o
    JOIN 
        Product pr ON o.product_id = pr.product_id
    JOIN 
        product_categori pc ON pr.catagori_id = pc.catagori_id";
        $serial=0;
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $serial=$serial +1;
        echo'  <tr>
        <th scope="row">'. $serial . '</th>
        <td>'. $row['catagory_name']  .'</td>
        <td>'. $row['order_quantity']  .'</td>
       
        </tr>';
          
        }

    ?>

    </tbody>
</table>
                </div>
            </div>
           </div>
                
                    
            


            
    <!-- Add these script tags in your HTML head section -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
  $(document).ready( function () {
    $('#myTable').DataTable({
      "paging": true,        // Enable paging
      "pageLength": 5,      // Number of rows per page
      "searching": true,     // Enable search
      "ordering": true,      // Enable sorting
      "info": true,          // Show information about the table
      "responsive": true     // Enable responsiveness
    });
  });
</script>

<script>
  $(document).ready( function () {
    $('#myTable1').DataTable({
      "paging": true,        // Enable paging
      "pageLength": 5,      // Number of rows per page
      "searching": true,     // Enable search
      "ordering": true,      // Enable sorting
      "info": true,          // Show information about the table
      "responsive": true     // Enable responsiveness
    });
  });
</script>
    
</body>
</html>