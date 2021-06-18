<?php
session_start();
require_once("connect.php");
$temp_loc=[];
foreach ($_FILES["images"]["tmp_name"] as $fname) {
	array_push($temp_loc, $fname);
}

$title=$_POST["title"];
$title = htmlentities($title);
$title = addslashes($title);
$content=$_POST["content"];
$content = htmlentities($content);
$content=addslashes($content);
$author=$_SESSION["Author"];
$author_id=$_SESSION["Author_ID"];
$query="INSERT INTO articles (`Title`,`Description`,`Author`,`Author_Id`)
		VALUES ('$title','$content','$author','$author_id')";
$result=$conn_article->query($query);
if(strlen($temp_loc[0])>0){
	$query="SELECT * FROM articles ORDER BY I_D DESC Limit 0,1";
	$result=$conn_article->query($query);
	$row=$result->fetch_assoc();
	$file_name=$row["I_D"];
	$location=[];
	$file_store="../../Data/articles/".$file_name.".jpg";
	$file_db="../Data/articles/".$file_name.".jpg";
	array_push($location, $file_db);
	for ($i=0; $i <count($temp_loc) ; $i++) {
		if ($i>0) {
		 	$file_store="../../Data/articles/".$file_name."-".$i.".jpg";
		 	$file_db="../Data/articles/".$file_name."-".$i.".jpg";
		 	array_push($location, $file_db);
		 } 
		move_uploaded_file($temp_loc[$i], $file_store);
	}
	$location=json_encode($location);
	$query="UPDATE articles SET location = '$location' WHERE I_D = '$file_name'";
	$result=$conn_article->query($query);
}
header("Location: ../../");
?>