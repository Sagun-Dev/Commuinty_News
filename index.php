<?php
session_start();
require_once("./Database/articles/connect.php");

$query="SELECT * FROM articles";
$result=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="./CSS/style_index.css">
</head>
<body>
<div id="nav">
	<div id="news">Daily News</div>
	<form id="search" action="./Search">
		<input type="text" name="search" id="search_field">
		<input type="submit" value="" id="search_btn">
	</form>
	<div><a href="./upload.php" id="upload" target="_blank">Upload</div></a>
	<?php
		if(isset($_SESSION["login"])){
	?>
	<div><a href="./logout.php" id="logout">Logout</a></div>
	<?php
		$profile = "./profile.php?"."author=".$_SESSION['Author']."&id=".$_SESSION['Author_ID'];
	?>
	<div><a href="<?=$profile ?>" id="profile" target="_blank">Profile</a></div>
	<?php
		}else{
	?>
	<div><a href="./login.php" id="login" target="_blank">Login</a></div>
	<div><a href="./signup.php" id="signup" target="_blank">Sign Up</a></div>
	<?php
		}
	?>
</div>
	<?php
		if($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$items[]=$row;
		}
		$items=array_reverse($items);
	?>
	<?php 
		foreach ($items as $row) {	
	 ?>
	<div id="card">
	<?php
		$content_loc = "./News?"."title=".$row['Title']."&id=".$row["I_D"];
	?>
	<a href="<?php echo $content_loc; ?>" id="title">
		<h1 style="margin-bottom: 0;"><?= $row['Title']; ?></h1>
	</a>
	&nbsp; &nbsp;<a href="<?= $profile ?>" id="author">	<span>  -<?= $row['Author']; ?></span></a><br>
	<div id="des">
		<?php
		$max_len=200;
		for($i=0;$i<$max_len;$i++){
			if($i>=strlen($row['Description'])){
				break;
			}
			echo $row['Description'][$i];
		}
		if(strlen($row['Description'])>$max_len){
			echo "...";
		}
		?>
	</div>
	</div>
	<?php
		}
		}
	?>
</div>
</body>
</html>