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
  $query="  SELECT
    pc.catagory_name,
    SUM(p.stockQuantity) as Quantity
  FROM
    product p
  JOIN product_categori pc ON p.catagori_id = pc.catagori_id
  GROUP BY pc.catagory_name";
  $res=mysqli_query($conn,$query);
  $test3=array();
  $count=0;
  while($row=mysqli_fetch_array($res)){
     $test3[$count]["label"]=$row["catagory_name"];
     $test3[$count]["y"]=$row["Quantity"];
     $count=$count+1;
 
  }
  
  ?>
   <?php
 
 $dataPoints = array(
     array("label"=> "Food + Drinks", "y"=> 590),
     array("label"=> "Activities and Entertainments", "y"=> 261),
     array("label"=> "Health and Fitness", "y"=> 158),
     array("label"=> "Shopping & Misc", "y"=> 72),
     array("label"=> "Transportation", "y"=> 191),
     array("label"=> "Rent", "y"=> 573),
     array("label"=> "Travel Insurance", "y"=> 126)
 );
     
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wellcome <?php echo $_SESSION['username'] ?></title>
    <link rel="stylesheet" href="wellcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    
    <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("char", {
	animationEnabled: true,
	theme: "light1",
	title:{
		text: "Inventory Forecasting"
	},
	axisY: {
		title: "Number of Quantity (in Quantity)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Quantity",
		dataPoints: <?php echo json_encode($test3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

         <style>
            .container2{
                height:150px;
                width:240px;
                display: flex;
                justify-content: space-between; 
                align-items: center;
            }
            .custom-theme1{
                border: 1px solid #dee2e6; 
                padding: 10px; 
                
                border-radius: 5px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                transition: transform 0.3s ease-in-out;

                height: 110px;
                width: 300px; 
                display: flex;
                justify-content: space-between; 
                align-items: center;
                color: black;
                
            }
            .custom-theme1 i{
                color: rgb(0, 0, 0);
                font-size: 70px;

            }   
            .main3 span{
                font-size: 40px;
                color: white;
            }
            .main3{
               
                position: relative;
              height: 150px;
                width: 240px; 
                top: -150px;
                display: flex;
                flex-direction: column;
                align-items: left   ;
                justify-content: center;
                


            }
            
           .custom-theme1:hover {
                transform: scale(1.05);
                cursor: pointer;
            }
            
          
        </style>
</head>
<body>
    <div class="container1 w-100"   >
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
        <a href="https://balachfarhadd.github.io/Box-Detection/" target="_blank"><button class="butn"><i class="fa-solid fa-camera"  style="color:white;"></i><h4 class="text1">WebCam</h4></button></a>

        <a href="/Ali/welcome.php"><button class="butn"><i id="icon" class="fa-solid fa-house"></i><h4 class="text1">Dashboard</h4></button></a>
             <a href="/Ali/productMeasurment.php"><button class="butn"><i id="icon" class="fa-brands fa-product-hunt"></i><h4 class="text1">Product Measurment</h4></button></a>

             <a href="/Ali/product.php"><button class="butn"><i id="icon" class="fa-brands fa-product-hunt"></i><h4 class="text1">Product</h4></button></a>
             <a href="/Ali/inventori.php"><button class="butn"><i id="icon" class="fa-solid fa-store"></i> <h4 class="text1">Inventory Managment</h4></button></a>
             <a href="/Ali/inventoryforecast.php"><button class="butn"><i id="icon" class="fa-solid fa-store"  ></i><h4 class="text1">Inventory Forecast  </h4></button></a>
             <a href="/Ali/orders.php"><button class="butn"><i id="icon" class="fa-solid fa-book"></i><h4 class="text1">Order</h4></button></a>
             <a href="/Ali/demandForcasting.php"><button class="butn"><i id="icon" class="fa-solid fa-book"></i><h4 class="text1">Demand Forecasting</h4></button></a>

             <a href="/Ali/sales.php"><button class="butn"><i id="icon" class="fa-brands fa-salesforce"></i><h4 class="text1">Sales</h4></button></a>
             <a href="/Ali/VendorInformation.php"><button class="butn"><i id="icon" class=" fa-solid fa-user"></i><h4 class="text1">Vendor Infromation</h4></button>

        </div>
        
        <div class="child2  my-0   py-4  px-5"  >

    
           <div class="container-fluid">
            <div class="row">    
           <div class="alert alert-primary" role="alert"  >
                <h4 class="alert-heading">Wellcome<h1><?php echo $_SESSION['username'] ?></h1></h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to exit this page and want to logout the press this link <a href="/Ali/logout.php">Logout</a></p>
              </div>

           </div>
           <div class="container-fluid">
            <div class="row  ">
                <div class="col-md-3 m-0 p-0   w-0 "   style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT COUNT(product_id) as total_orders FROM product";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2">  <div class="txt1  "  ></div><div class="font1"  ><i class="fab fa-product-hunt pr-5" style="color:black;  font-size:90px;"></i></div></div><div class="main3" style="  background-image:linear-gradient(to right ,rgba(0, 119, 255, 0.579) , rgba(0, 128, 255, 0.574));"><div class="main2  text-left"  ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  "><span><b>Product</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                <div class="col-md-3    "  style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT COUNT(order_id) as total_orders FROM ordrs";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2"  >  <div class="txt1  "  ></div><div class="font1"  ><i class="fab fa-first-order pr-5" style="color:black;  font-size:90px;"></i></div></div><div class="main3"  style=" background-image:linear-gradient(to top,rgba(0, 105, 0, 0.89), rgba(0, 128, 0, 0.611));" ><div class="main2  text-left"  ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  "><span><b>Orders</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                <div class="col-md-3  "  style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT COUNT(salesid) as total_orders FROM sales";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2">  <div class="txt1  "  ></div><div class="font1"  ><i class="fa-solid fa-cart-shopping pr-5"  style="color:black;  font-size:90px;"></i></div></div><div class="main3"  style=" background-image:linear-gradient(to top,rgb(221, 210, 2), rgba(179, 176, 2, 0.748));" ><div class="main2  text-left"  ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  "><span><b>Sales</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                <div class="col-md-3  "  style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT sum(stockQuantity) as total_orders FROM `product` ";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2">  <div class="txt1  "  ></div><div class="font1"  ><i class="fa-solid fa-warehouse   pr-5 "  style="color:black;  font-size:90px;"></i></div></div><div class="main3"  style="                background-image:linear-gradient(to top,rgb(214, 154, 0), rgba(4, 41, 225, 0.655));"><div class="main2  text-left"  ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  "><span><b  style="font-size :25px;">Avaiblable Stock</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                
                </div>
                
                </div>
               
            </div>
                
            <div class="container-fluid">
                <div class="row">

                
                    <div class="col-md-3 m-o p-o mt-5  w-0 "   style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT sum(order_quantity  ) as total_orders FROM `ordrs` ";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2  ">  <div class="txt1  "  ></div><div class="font1"   ><i class="fa-brands fa-jedi-order  pr-3  pb-5"  style="color:black;  font-size:90px;  "></i></div></div><div class="main3"      style="                background-image:linear-gradient(to top,rgba(0, 214, 196, 0.825), rgba(4, 41, 225, 0.655));"                    ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  0"><span  style="font-size:25px;"><b>Available Order</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                    
            </div>
            
            <div class="col-md-3 m-o p-o mt-5  w-0"   style="height:150px;">
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT count(catagory_name  ) as total_orders FROM `product_categori` ";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container2  ">  <div class="txt1  "  ></div><div class="font1"   ><i class="fa-solid fa-list  fa-jedi-order  pr-3  pb-5"  style="color:black;  font-size:90px;  ""></i></div></div><div class="main3"      style="                background-image:linear-gradient(to top,rgba(0, 214, 196, 0.825), rgba(4, 41, 225, 0.655));"                    ><span  ><b style="padding-left:40px">'.$row['total_orders'].'</b></span> <div class="main1  text-left"  style="   padding-left:0px;  0"><span  style="font-size:25px;"><b>Catagories</b></span></div></div></div></div>
                    ';
                } else {
                    echo "No orders found";
                }
                ?>
                
            </div>
           
                </div>
                

                
                </div>
                
                
                
            </div>
            
            
            <div class="col-md-3 bg-none "   style="position:absolute; top:500px;  left:1000px">
            <?php
                include "saledash.php";
            ?>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12  "  style="position:absolute; top: 500px;  left:500px; ">
                  
                    <div class="b">

                    
                    <table class="table  my-1  "  id="myTable"   style="overflow:hidden;" >
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">catagory_name</th>
      <th scope="col">measurement_value</th>
      


    </tr>
  </thead>
  <tbody>
  <?php
        $sql="SELECT pc.catagory_name, pm.measurement_value FROM  Product p  JOIN  product_categori pc ON p.catagori_id = pc.catagori_id JOIN    measurmentproduct pm ON p.measurment_id = pm.measurment_id";
        $serial=0;
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $serial=$serial +1;
        echo'  <tr>
        <th scope="row">'. $serial . '</th>
        <td>'. $row['catagory_name']  .'</td>
        <td>'. $row['measurement_value']  .'</td>
       
        </tr>';
          
        }

    ?>

    </tbody>
</table>
           
                
                   
        </div> 

        
            </div>
<div class="col-md-10"   style="postion:absolute; top:100px; left:200px;">
    <?php
include "barchart.php";
    ?>
</div>
            
  
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
        
        
        </div> -->

        </div>
       

           
           <!-- <div class="contianer">
            <div class="row">
                <div class="col-md-3">
                    <div class="b">

                    
                <?php
                include 'dbconnected.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT COUNT(product_id) as total_orders FROM product";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="container"> <div class="custom-theme" style="background-color:rgba(168, 168, 168, 0.968);"> <div class="main"> <div class="font"> <h3><i class="fa-brands fa-product-hunt"></i>
                    </h3><p><b class="h5 mb-5 font-weight-bold">PRODUCT</b></p> </div> <div class="torder " ><h3   style="font-size:50px;" >'.$row['total_orders'] .'</h3></div></div></div>';
                } else {
                    echo "No orders found";
                }
                ?>
                </div>
                  
            </div> 
                    
            </div> -->
            <!-- <div class="col-md-3">
            <div class="b">

                    
<?php
include 'dbconnected.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(order_id) as total_orders FROM ordrs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="container"> <div class="custom-theme"> <div class="main"> <div class="font"> <h3><i class="fa-brands fa-first-order"></i></i></h3><p><b class="h3  font-weight-bold">Order</b></p> </div> <div class="torder " ><h3   style="font-size:50px;" >'.$row['total_orders'] .'</h3></div></div></div>';
} else {
    echo "No orders found";
}
?>
</div>

            </div>
            
            </div> -->
            <!-- <div class="b">

                    
<?php
include 'dbconnected.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(salesid) as total_orders FROM sales";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="container"> <div class="custom-theme" style=" background-color: rgba(206, 209, 60, 0.732);    "> <div class="main"> <div class="font"> <h3><i class="fa-brands fa-salesforce"></i></h3><p class="h3"><b>Sales</b></p> </div> <div class="torder " ><h3   style="font-size:50px;" >'.$row['total_orders'] .'</h3></div></div></div>';
} else {
    echo "No orders found";
}
?>
</div>
</div> -->
<!-- <div class="col-md-3">
<div class="b">

                    
<?php
include 'dbconnected.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sum(stockQuantity) as total_orders FROM `product` ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="container"> <div class="custom-theme"   style="background-color: rgba(147, 45, 236, 0.732);  width:100%;"> <div class="main"> <div class="font"> <h3><i class="fa fa-industry" aria-hidden="true"></i>    </i></h3><p><b  class="h5  font-weight-bold">Available Stock</b></p> </div> <div class="torder " ><h3   style="font-size:50px;" >'.$row['total_orders'] .'</h3></div></div></div>';
} else {
    echo "No orders found";
}
?>
</div>

            </div>
            
            </div> -->

            <!-- <br>
            <div class="container-fluid  ">
            <h1>Graph</h1>

                <div class="row">

                    <div class="col-md-6 ">
                    <div id="chartContainer" style="height: 370px; width:100%;"></div>

                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                    </div>
                    <div class="col-md-6">
                  
                    <div class="b">

                    
                    <table class="table  my-1"  id="myTable">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">catagory_name</th>
      <th scope="col">measurement_value</th>
      
s

    </tr>
  </thead>
  <tbody>
  <?php
        $sql="SELECT pc.catagory_name, pm.measurement_value FROM  Product p  JOIN  product_categori pc ON p.catagori_id = pc.catagori_id JOIN    measurmentproduct pm ON p.measurment_id = pm.measurment_id";
        $serial=0;
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $serial=$serial +1;
        echo'  <tr>
        <th scope="row">'. $serial . '</th>
        <td>'. $row['catagory_name']  .'</td>
        <td>'. $row['measurement_value']  .'</td>
       
        </tr>';
          
        }

    ?>

    </tbody>
</table>
           
                
                   
        </div> 

        
            </div>
            
            
            </div>
            

                    </div>

                </div>
                
            </div> -->
            
<!--                                                   
<div class="contianer">
    <div class="row">
    <div class="col-md-6  ">
    <div id="piechart" style="width: 100%; height: 500px;"></div>

    </div>
    <div class="col-md-6 ">
    <div id="barchart_values" style="width:100%; height: 300px;"></div>

    </div>
</div>
</div>

        </div>
        
    </div> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
  $(document).ready( function () {
    $('#myTable').DataTable({
      "paging": true,      
      "pageLength": 5,     
      "searching": true,    
      "ordering": true,      
      "info": true,          
      "responsive": true     
    });
  });
</script>

    
</body>
</html>