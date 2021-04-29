<?php
session_start();
require_once("../Database/articles/connect.php");
$title=$_REQUEST['title'];
$id=$_REQUEST["id"];
$title=htmlentities($title);
$query="SELECT * FROM articles WHERE Title='$title' and I_D='$id'";
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
	<a href="../"><span id="news">Daily News</span></a>
	<div id="search">
		<form action="../Search">
			<input type="text" name="search" id="search_field" placeholder="Search">
			<input type="submit" value="" id="search_btn">
		</form>
	</div>
	<div class="upload"><a href="../upload.php" class="upload" target="_blank">Upload</div></a>
	<?php
		if(isset($_SESSION["login"])){
	?>
	<div class="logout"><a href="../logout.php" class="logout">Logout</a></div>
	<?php
		$profile = "../profile.php?"."author=".$_SESSION['Author']."&id=".$_SESSION['Author_ID'];
	?>
	<div class="profile"><a href="<?=$profile ?>" class="profile" target="_blank">Profile</a></div>
	<?php
		}else{
	?>
	<div class="login"><a href="./login.php" class="login" >Login</a></div>
	<div class="signup"><a href="./signup.php" class="signup" target="_blank">SignUp</a></div>
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