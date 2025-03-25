<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrion form</title>
</head>
<body>
    <form action="registration.php" method="POST">
    <label>username</label>    
    <input type="text" name="username">
    <br>
    <label>password</label>    
    <input type="password" name="pass">
    <br>
    <input type="submit" name="submit" value="submit">
    </form>
    
</body>
</html>
<?php
include("database.php");
function check(string $user){
global $conn;
$stmt= mysqli_stmt_init($conn);
$sql = "SELECT username from PASS WHERE username = ?";
if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "statement failed";
    return -1;
}
    mysqli_stmt_bind_param($stmt,"s",$user);
    mysqli_stmt_execute($stmt);
    $result= mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){return 1;}
        
        
    else{
        return 0;
    }
    
    
mysqli_stmt_close($stmt);
}



function insert(string $user,string $pass){
    global $conn;
    $sql = "INSERT INTO PASS(username,pass) VALUES(?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "statement failed";
        return 0;
    }

        mysqli_stmt_bind_param($stmt,"ss",$user,$pass);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return 1;

}
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $user = $_POST["username"];
   // $email= $_POST["email"];
    //$tel =  $_POST["tel"];
    $pass = password_hash( $_POST["pass"],PASSWORD_DEFAULT);
    if(isset($_POST["submit"])){
        $check = check($user);
        echo $check;
        if($check === 1){
            echo "username taken";

        }
        elseif($check===0){
            $insert=insert($user, $pass );
            if($insert === 1){
                echo"registration complet please login";
                header("refresh:2 ;url=index.php");
                exit();
            }
            else{
                echo "registration failed please try agins";
            }
        }
        else{
            //echo"unkwown error ocuuredd";
        }
    }
}
?>