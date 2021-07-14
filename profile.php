<?php
require_once("./Database/articles/connect.php");
require_once("./Database/users/connect.php");
$author=$_REQUEST["author"];
$name=explode(" ", $author);
$id=$_REQUEST["id"];
$query="SELECT * FROM users WHERE I_D='$id' and First_Name='$name[0]' and Last_Name='$name[1]'";
$result=$conn->query($query);
$query="SELECT upvotes,downvotes FROM articles WHERE Author_ID='$id' ";
$articles=$conn_article->query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile <?=$_REQUEST["author"]?></title>
	<link rel="stylesheet" type="text/css" href="./CSS/profile.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style_index.css">
	<meta name="viewport" content="width=device-width">
	<link rel="icon" href="./images/fav.ico" />
</head>
<body>
	<nav id="nav">
	<div id="news"><a href="./index.php">Daily News</a></div>
	<ul class="nav-links">
		<li><form action="./Search" id="search">
			<input type="text" name="search" id="search_field" placeholder="Search">
			<input type="submit" value="search" id="search_btn">
		</form><li>
		<li><a href="./upload.php" class="upload" target="_blank">Upload</a></li>
		<?php
			if(isset($_SESSION["login"])){
		?>
		<li><a href="./logout.php" class="logout">Logout</a></li>
		<?php
			$profile = "./profile.php?"."author=".$_SESSION['Author']."&id=".$_SESSION['Author_ID'];
		?>
		<li><a href="<?=$profile ?>" class="profile" target="_blank">Profile</a></li>
		<?php
			}else{
		?>
		<li><a href="./login.php" class="login" >Login</a></li>
		<li><a href="./signup.php" class="signup" target="_blank">SignUp</a></li>
		<?php
		}
	?>
	</ul>
</nav>
<div id="out">
	<div id="profile">
		<?php
		if($result->num_rows>0){
			$count=0;
			while($row=$result->fetch_assoc()){
				if ($count==0 && $row["profile_pic"]) {
					$location=$row["profile_pic"];
		?>
					<img src="<?=$location?>" alt="profile pic" id="image"><br>
		<?php
				}else{
		?>
					<img src="https://raw.githubusercontent.com/Sagun-Dev/img/main/profile.ico" alt="profile pic" id="image"><br>
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
		<?php
			if($articles->num_rows>0){
				$upvotes = 0;
				$downvotes = 0;
				$trustscore = 0;
				while($row = $articles->fetch_assoc()){
					$upvotes+=$row["upvotes"];
					$downvotes+=$row["downvotes"];					
				}
				if($upvotes+$downvotes != 0){
					$trustscore = $upvotes/($upvotes+$downvotes)*100;
				}?>
				<label id="totalup">Total Upvotes: <?=(int)$upvotes?></label><br>
				<label id="totaldown">Total Upvotes: <?=(int)$downvotes?></label><br>
				<label id="total">Total Upvotes: <?=(int)$upvotes+$downvotes?></label><br>
				<label id="trust">Trust Score: <?=(int)$trustscore?></label><br>
				<?php
			}
		?>
		
	</div>
</div>
<footer>
    <div class="footer">
        <div>
            <h1>Daily News</h1> 
        </div>
        <div>
        	<h5>Useful Links</h5><br>
            <ul>
                <li><a href="guide.php" style="color:white;">Guide</a></li>
            </ul>
        </div>

        <div>
            <h5>Contact Us</h5>
            <ul>
                <li>example@news.com</li>
                <li>Pokhara, Nepal</li>
            </ul>
        </div>
    </div>
    </footer>
</body>
</html>