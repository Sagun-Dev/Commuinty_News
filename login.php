<?php
session_start();
if(count($_POST)>0){
	session_destroy();
}else if(isset($_SESSION["login"])){
	header("Location: ./");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="./CSS/login.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style_index.css">
	<meta name="viewport" content="width=device-width">
	<link rel="icon" href="https://raw.githubusercontent.com/Sagun-Dev/img/main/fav.ico" />
</head>
<body>
	<nav id="nav">
	<div id="news"><a href="index.php">Daily News</a></div>
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
	</ul>
	<?php
		}
	?>
</nav>
	<div id="out">
		<div id="login">
			<form action="./Database/users/login.php" method="post">
				<div id="header"><label>LOGIN</label></div><br>
				<input type="email" id="email" placeholder="Email" name="email" required>
				<br><br>
				<input type="password" id="password" placeholder="Password" name="password" required>
				<br><br>
				<div><input type="Submit" value="Login" id="submit"></div><br>
				<div><input type="reset" id="reset"></div>
			</form>
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