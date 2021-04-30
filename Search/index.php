<?php
session_start();
require_once("../Database/articles/connect.php");
$search=$_GET["search"];
$query="SELECT * FROM articles WHERE Title LIKE '%$search%' or Description LIKE '%$search%'";
$result=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../CSS/style_index.css">
</head>
<body>
<div id="nav">
	<a href="../"><span id="news"> Daily News</span></a>
	<div id="search">
		<form action=".">
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
	<div class="login"><a href="../login.php" class="login" >Login</a></div>
	<div class="signup"><a href="../signup.php" class="signup" target="_blank">SignUp</a></div>
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
	<div class="card">
	<?php
		$content_loc = "../News?"."title=".$row['Title']."&id=".$row["I_D"];
		$profile = "./profile.php?"."author=".$row['Author']."&id=".$row['Author_ID'];
	?>
	<a href="<?php echo $content_loc; ?>" class="title">
		<h1 style="margin-bottom: 0;"><?= $row['Title']; ?></h1>
	</a>
	&nbsp; &nbsp;<a href="<?= $profile ?>" class="author">	<span>  -<?= $row['Author']; ?></span></a><br>
	<div class="des">
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