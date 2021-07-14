<?php
session_start();
require_once("../Database/articles/connect.php");
$search = $_GET["search"];

if(!isset($page)){
	$page = 1;	
}
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
$offset = ($page-1)*10;
$query="SELECT * FROM articles WHERE Title LIKE '%$search%' or Description LIKE '%$search%' Limit "."$offset"." ,10";
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
<nav id="nav">
	<div id="news"><a href="../">Daily News</a></div>
	<ul class="nav-links">
		<li><form action="../Search" id="search">
			<input type="text" name="search" id="search_field" placeholder="Search">
			<input type="submit" value="search" id="search_btn">
		</form><li>
		<li><a href="../upload.php" class="upload" target="_blank">Upload</a></li>
		<?php
			if(isset($_SESSION["login"])){
		?>
		<li><a href="../logout.php" class="logout">Logout</a></li>
		<?php
			$profile = "../profile.php?"."author=".$_SESSION['Author']."&id=".$_SESSION['Author_ID'];
		?>
		<li><a href="<?=$profile ?>" class="profile" target="_blank">Profile</a></li>
		<?php
			}else{
		?>
		<li><a href="../login.php" class="login" >Login</a></li>
		<li><a href="../signup.php" class="signup" target="_blank">SignUp</a></li>
		<?php
		}
	?>
	</ul>
	<div class="burger">
		<div class="line1"></div>
		<div class="line2"></div>
		<div class="line3"></div>
	</div>
	
</nav>
<?php
		if($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$items[]=$row;
		}
		$items=array_reverse($items);
	?>
	<?php 
		$iteration = 0;
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
			<div class="vote">
				<img src="../images/upvote.png" alt="upvote" width="20" height="20" onclick="upvote(<?=$iteration?>,<?=$row['I_D']?>)">
				<label style="font-size:1.5rem" class="up"><?=$row['upvotes']?></label>
				<img src="../images/downvote.png" alt="downvote" width="20" height="20" onclick="downvote(<?=$iteration?>,<?=$row['I_D']?>)">
				<label style="font-size:1.5rem" class="dn"><?=$row['downvotes']?></label>
			</div>
			<a href="<?= $profile ?>" class="author">	<span>  -<?= $row['Author']; ?></span></a><br>
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
			$iteration++;
		}
		}
	?>
	</div>
	<form action="#" method="get">
		<div id="container">
		<?php
			if($result->num_rows==10){
		?>
				<button type="submit"  id="next" name="page" value=<?=$page+1?>>Next</button>
				<input type="hidden" name="search" value="<?=$search?>">
		<?php
		}?><?php
			if($page>1){
		?>
				<button type="submit" id="prev"  name="page" value=<?=$page-1?>>Previous</button>
				<input type="hidden" name="search" value="<?=$search?>">
		<?php

			}
		?>
	</div>
	</form>

	<footer>
    <div class="footer">
        <div>
            <h1>Daily News</h1> 
        </div>
        <div>
        	<h5>Useful Links</h5><br>
            <ul>
                <li><a href="../guide.php" style="color:white;">Guide</a></li>
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
    <script type="text/javascript">
    	var response;
    	function upvote(article_position,id){
    		saveVote(article_position,id,1);
		}
    	function downvote(article_position,id){
    		saveVote(article_position,id,-1);
    		
    	}
    	function saveVote(article_position,id,vote){
    		//"use strict";   
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("POST", "../Database/articles/vote.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.onreadystatechange = function() {
			    if (this.readyState === 4 || this.status === 200){ 
			        response = this.responseText; // echo from php
			        response = response.split(",");
			        if(response.length>0){
				        document.getElementsByClassName("up")[article_position].textContent = response[0];
						document.getElementsByClassName("dn")[article_position].textContent = response[1];
					}
			    }       
			};
			xmlhttp.send("id=" + id+"&vote=" + vote);
			
    	}
    </script>
    <script src="../app.js"></script>
</body>
</html>