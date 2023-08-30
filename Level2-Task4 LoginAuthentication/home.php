<?php
include_once "../authguard.php";
include "navbar.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <div style="display:flex;flex-wrap: wrap;
    justify-content: space-around;">
    <?php
function init_db(){
    $conn = new mysqli("localhost","root","","acemegrade_ecomerce");

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";
    return $conn;
}
function end_db($conn){
    $conn->close();
}

    // session_start();
    $sid="".$_SESSION["uid"];
    $sidint=intval($sid);
    $conn=init_db();

    $str="";
$sql = "SELECT * FROM product ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    // echo "<br> id: ". $row["user_type"]. " - Name: ". $row["username"]. " " . $row["password"] . "<br>";

$imgpath=$row["product_image_path"];
$pid=$row["product_id"];
$prodname=$row["product_name"];
$prodprice=$row["product_price"];
$proddesc=$row["product_desc"];
     $str=$str."
     <div class='card m-3' style='width: 18rem;'>
     <center>
     <img src='$imgpath' class='card-img-top' style='max-height: 200px;object-fit: contain;'>
     <div class='card-body'>
     <h5 class='card-title'>$prodname</h5>
     <p class='card-text'>$proddesc</p>
     <h6 class='card-title'>$$prodprice</h6>
     
     <form action='addtocart.php' method='post'>
     <input type='hidden' name='pid' value='$pid'>
     <input type='hidden' name='pname' value='$prodname'>
     
     <button  class='btn btn-primary' onclick='submit'>Add to Cart</button>
     </form>
     </div>
     </center>
     </div>";
}
echo $str;
}
  
    ?>
    </div>

</body>
</html>