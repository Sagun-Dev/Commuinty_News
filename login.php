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
</head>
<body>
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
</body>
</html>