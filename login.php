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
</head>
<body>
<form action="./Database/user/login.php" method="post">
	<label for=email>Email</label>
	<input type="email" id="email" placeholder="email" name="email" required>
	<br><br>
	<label for=password>Password</label>
	<input type="password" id="password" placeholder="password" name="password" required>
	<br><br>
	<input type="Submit" value="login">
	<input type="reset">
</form>
</body>
</html>