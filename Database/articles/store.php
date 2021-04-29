<?php
session_start();
require_once("connect.php");
require_once("../users/connect.php");
$title=$_POST["title"];
$title = htmlentities($title);
$content=$_POST["content"];
$content = htmlentities($content);
$content=addslashes($content);

$query='SELECT First_Name,Last_Name,I_D FROM users ';
$result=$conn->query($query);

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){

		$author=$row["First_Name"]." ".$row["Last_Name"];
		$author_id=$row["I_D"];
	}
}


$query="INSERT INTO articles (`Title`,`Description`,`Author`,`Author_Id`)
		VALUES ('$title','$content','$author','$author_id')";
$conn_article->query($query);
header("Location: ../../");
?>