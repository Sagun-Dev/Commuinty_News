<?php
session_start();
require_once("connect.php");
$email=$_POST["email"];
$password=$_POST["password"];
$query="SELECT * FROM users WHERE Email='$email' and Password='$password'";
$result=$conn->query($query);
var_dump($result);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
    if($email == $row["Email"] and $password == $row["Password"]){
    	$_SESSION["login"]=true;
    	$_SESSION["Author"]=$row["First_Name"]." ".$row["Last_Name"];
    	$_SESSION["Author_ID"]=$row["I_D"];
    	header("Location: ../../");
    }else{
    	header("Location: ../../login.php");
    }
  }
}else{
	header("Location: ../../login.php");
}
?>