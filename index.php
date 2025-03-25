<?php

use Slim\Psr7\Cookies;

//include("header.html");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>you little ass</title>
</head>
<body>
  <div>
  <form action="index.php" method="POST">
    usernname   
    <input type="text" name="username">
    <br>
    password
    <input type="password" name="pass">
    <br>
   <input type="submit" name="login" value="LOGIN">
   <br>
   <input type="submit" name="register" value="register">
  </form>
</body>
</html>
<?php
include("database.php");
function login(string $user, string $pass){
global $conn;
$ret = 0;

$sql= "SELECT username , pass FROM PASS where username = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
   echo "failed";

    }
  
else{
   mysqli_stmt_bind_param($stmt,"s",$user);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   while($row=mysqli_fetch_assoc($result)){
     if(password_verify($pass,$row["pass"])){
       $ret = 1;
       return $ret; 
  }
}
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
return $ret;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["login"])) {
      $user = $_POST["username"] ?? "";
      $pass = $_POST["pass"] ?? "";

      $log = login($user, $pass);

      if ($log === 1) {
          header("Location: home.php");
          exit();
      } else {
          echo "Wrong username or password";
      }
  } elseif (isset($_POST["register"])) {
      header("Location: registration.php"); 
      exit();
  }
}
$res = password_hash("manzi123",PASSWORD_DEFAULT);


?>