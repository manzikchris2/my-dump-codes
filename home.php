<?php
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>welcome to the home page</h1>
   <?php
    global $conn;
    $sql = "SELECT productName,quantity FROM products WHERE quantity>0";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)>0){
   echo "<p>below is the list of products we have in stock</p>";
    while($row = mysqli_fetch_assoc($result)){
        echo"{$row["productName"]}:{$row["quantity"]} <br>";
    }
  
   }
   else{
    echo"we are out of stock";
}
mysqli_close($conn);
    ?>
    
</body>
</html>