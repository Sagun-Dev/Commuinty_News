<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="./CSS/signup.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style_index.css">
	<link rel="icon" href="./images/fav.ico" />
	<meta name="viewport" content="width=device-width">
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
		<div id="signup">
			<form onsubmit="return check()" action="./Database/users/register.php" method="post" enctype="multipart/form-data">
				<div id="header"><label>LOGIN</label></div><br>
				<input type="text" name="fname" id="fname" placeholder="First Name" required>
				<br><br>
				<input type="text" name="lname" id="lname" placeholder="Last Name" required>
				<br><br>
				<label for=dob id="dob_lbl">DOB: </label>
				<input type="date" name="dob" id="dob" required>
				<br><br>
				<label id="gender_lbl">Gender: </label><br>
				<input type="radio" name="gender" value="male" id="male" required>
				<label for="male" style="color: white;">Male</label><br>
				<input type="radio" name="gender" value="female" id="female" required>
				<label for="female" style="color: white;">Female</label><br>
				<input type="radio" name="gender" value="other" id="other" required>
				<label for="other" style="color: white;">Other</label><br>
				<br><br>
				<input type="email" name="email" id="email" placeholder="Email" required>
				<br><br>
				<input type="password" name="password" id="password" placeholder="Password" required>
				<label id="warning"></label>
				<br><br>
				<label id="profile-lbl">Profile Pic</label><br>
				<input type="file" name="image" id="profile"><br><br>
				<input type="submit" value="Register" id="submit"><br><br>
				<input type="reset" id="reset">
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
    <script type="text/javascript">
    	function check(){
    		var firstname = document.getElementById("fname").value;
    		var lastname = document.getElementById("lname").value;
    		if(firstname.trim().length>0 && lastname.trim().length>0){
    			return true;
    		}else if(firstname.trim().length==0 && lastname.trim().length==0){
    			document.getElementById("fname").style.borderColor = "red";
    			document.getElementById("lname").style.borderColor = "red";
    		}else if(lastname.trim().length==0){
    			document.getElementById("lname").style.borderColor = "red";
    		}else{
    			document.getElementById("fname").style.borderColor = "red";
    		}
    		return false;
    		
    	}
    </script>
</body>
</html>