<?php
require_once("connect.php");

$first_name=$_POST["fname"];
$last_name=$_POST["lname"];
$dob=$_POST["dob"];
$gender=$_POST["gender"];
$email=$_POST["email"];
$password=$_POST["password"];
$query="INSERT INTO users (`First_Name`,`Last_Name`,`DOB`,`Gender`,`Email`,`Password`)
		VALUES ('$first_name','$last_name','$dob','$gender','$email','$password')";
$conn->query($query);
if(strlen($_FILES["image"]["tmp_name"])>0){
	$location=$_FILES["image"]["tmp_name"];
	$query="SELECT * FROM users ORDER BY I_D DESC Limit 0,1";
	$result=$conn->query($query);
	$row=$result->fetch_assoc();
	$file_name=$row["I_D"];
	$file_store="../../Data/profile/".$file_name.".jpg";
	$file_db="./Data/profile/".$file_name.".jpg";
	move_uploaded_file($location, $file_store);
	$query="UPDATE users SET profile_pic = '$file_db' WHERE I_D = '$file_name'";
	$result=$conn->query($query);
	var_dump($result);
}
header("Location: ../../login.php");
?>