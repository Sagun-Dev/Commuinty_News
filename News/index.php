<?php
session_start();
require_once("../Database/articles/connect.php");
$title=$_REQUEST['title'];
$id=$_REQUEST["id"];
$title=htmlentities($title);
$title_show=addslashes($title);
$query="SELECT * FROM articles WHERE Title='$title_show' and I_D='$id'";
$result=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $_REQUEST['title']?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../CSS/style_index.css">
</head>
<body style="background-image: none;">
<div id="nav">
	<div id="grid">
	<a href="../"><span id="news">Daily News</span></a>
		<form action="../Search" id="search">
			<input type="text" name="search" id="search_field" placeholder="Search">
			<input type="submit" value="" id="search_btn">
		</form>
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
</div></div>
<?php
if($result->num_rows > 0){
while($row = $result->fetch_assoc()) {
	$locations=$row['location'];
	$locations=json_decode($locations);
	$img_counter=0;
	if(isset($locations)){
		$location=$locations[$img_counter];
	}
?>
<h1 style="text-align: center;"><?= $row["Title"]?></h1>
<?php
	$string=$row["Description"];
	$string=str_split($string);
	$description="";
	foreach ($string as $str) {
		if($str==chr(10)){
			$description.="<br>";
		}else{
			$description.=$str;
		}
	}
	$search="[img]";
	$image_to_add=true;
	while(true){
		if(isset($locations)){
			$replace="<img src='$location' style='width: 100%; height: auto'>";
			$description=str_replace("/[img]","&sl&bbimg&bb","$description");
			if(preg_match ("{\[img\]}","$description")){
				$image_to_add=false;
			}
			$description=preg_replace ("{\[img\]}","$replace","$description",1);
			$img_counter+=1;
			if($img_counter>=count($locations)){
				$description=preg_replace ("{\[img\]}","","$description");
				break;
			}
			$location=$locations[$img_counter];
		}else{
			break;
		}
	}
	$description=str_replace("&sl&bbimg&bb","[img]","$description");
	?> <div style="color: black; font-size: 1.5rem;"><?="$description";?></div>
	<?php
	if($image_to_add){
		if(isset($locations)){
			foreach ($locations as $location) {?>
				<img src="<?=$location?>" style='width: 100%; height: auto'><?php
			}
			var_dump($locations);
		}
	}?>
<?php
}
}
?>

</body>
</html>