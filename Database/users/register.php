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
header("Location: ../login.php");
$conn->query($query);
?>