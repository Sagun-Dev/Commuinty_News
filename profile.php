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
	<link rel="stylesheet" type="text/css" href="./CSS/profile.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
<div id="out">
	<div id="profile">
		<?php
		if($result->num_rows>0){
			$count=0;
			while($row=$result->fetch_assoc()){
				if ($count==0 && $row["profile_pic"]) {
					$location=$row["profile_pic"];
		?>
					<img src="<?=$location?>" id="image"><br>
		<?php
				}else{
		?>
					<img src="./images/profile.ico" id="image"><br>
		<?php
				}
		?>
			<label id="name">Name: <?=$row["First_Name"]." ".$row["Last_Name"]?></label><br>
			<label id="dob">DOB: <?=$row["DOB"]?></label><br>
			<label id="gender">Gender: <?=$row["Gender"]?></label><br>
			<label id="email">Email: <?=$row["Email"]?></label><br>
		<?php
		}
		}else{
			die("Invalid Details");
		}?>
		<?php
		if($articles->num_rows>0){
		?>
		<label id="contribution">Articles Contributed: <?=$articles->num_rows?></label><br>
		<?php

		}?>
	</div>
</div>
</body>
</html>