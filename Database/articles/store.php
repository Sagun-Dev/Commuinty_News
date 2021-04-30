<?php
session_start();
require_once("connect.php");
//require_once("../users/connect.php");
$title=$_POST["title"];
$title = htmlentities($title);
$content=$_POST["content"];
$content = htmlentities($content);
$content=addslashes($content);

var_dump($_SESSION);

$author=$_SESSION["Author"];
$author_id=$_SESSION["Author_Id"];
$query="INSERT INTO articles (`Title`,`Description`,`Author`,`Author_Id`)
		VALUES ('$title','$content','$author','$author_id')";
$conn_article->query($query);
header("Location: ../../");
?>