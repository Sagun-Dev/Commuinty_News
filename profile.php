<?php
require_once("./Database/articles/connect.php");
require_once("./Database/users/connect.php");
$author=$_REQUEST["author"];
$name=explode(" ", $author);
$id=$_REQUEST["id"];
$query="SELECT * FROM users WHERE I_D='$id' and First_Name='$name[0]' and Last_Name='$name[1]'";
$result=$conn->query($query);
$query="SELECT * FROM articles WHERE Author_ID='$id' ";
$articles=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$_REQUEST["author"]?></title>
</head>
<body>
<?php
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){?>
	<label>Name: <?=$row["First_Name"]." ".$row["Last_Name"]?></label><br>
	<label>DOB: <?=$row["DOB"]?></label><br>
	<label>Gender: <?=$row["Gender"]?></label><br>
	<label>Email: <?=$row["Email"]?></label><br>
<?php
}
}else{
	die("Invalid Details");
}?>
<?php
if($articles->num_rows>0){
?>
<label>Articles Contributed: <?=$articles->num_rows?></label><br>
<?php

}?>
</body>
</html>