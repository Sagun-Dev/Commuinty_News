<?php
session_start();
require_once("../Database/articles/connect.php");
$title=$_REQUEST['title'];
$title=htmlentities($title);
$query="SELECT * FROM articles WHERE Title='$title'";
$result=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $_REQUEST['title']?></title>
	<link rel="stylesheet" type="text/css" href="../CSS/style_index.css">
</head>
<body>
<div id="nav">
	<a href="../"><div id="news"> Daily News</div></a>
	<form id="search" action="./Search">
		<input type="text" name="search" id="search_field">
		<input type="submit" value="" id="search_btn">
	</form>
	<div><a href="./upload.php" id="upload">Upload</div></a>
	<?php
		if(isset($_SESSION["login"])){
	?>
	<div><a href="./logout.php" id="logout">Logout</a></div>
	<div><a href="./profile.php" id="profile" target="_blank">Profile</a></div>
	<?php
		}else{
	?>
	<div><a href="./login.php" id="login">Login</a></div>
	<div><a href="./signup.php" id="signup">Sign Up</a></div>
	<?php
		}
	?>
</div>
<?php
if($result->num_rows > 0){
while($row = $result->fetch_assoc()) {
?>
<h1 style="text-align: center;"><?= $row["Title"]?></h1>
<p><?=$row["Description"]?></p>
<?php
}
}
?>
</div>
</body>
</html>