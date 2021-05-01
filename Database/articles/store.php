<?php
session_start();
require_once("connect.php");
// require_once("../users/connect.php");
$title=$_POST["title"];
$title = htmlentities($title);
$title = addslashes($title);
// var_dump($_POST);
$content=$_POST["content"];
$content = htmlentities($content);
$content=addslashes($content);
$author=$_SESSION["Author"];
$author_id=$_SESSION["Author_ID"];
$query="INSERT INTO articles (`Title`,`Description`,`Author`,`Author_Id`)
		VALUES ('$title','$content','$author','$author_id')";
$result=$conn_article->query($query);
// var_dump($result);
header("Location: ../../");
?>