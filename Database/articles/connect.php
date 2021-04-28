<?php
$hostname="localhost";
$username="root";
$password="";
$database="news";
$conn_article=new mysqli($hostname,$username,$password,$database);
if ($conn_article->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>