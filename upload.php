<?php
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
	<form action="./Database/articles/store.php" method="post">
		<label for=title>Title:</label><br>
		<input type="text" name="title" id="title"><br><br>
		<label for=content>Desciption:</label><br>
		<textarea name="content" id="content"></textarea><br><br>
		<input type="Submit" value="Publish">
		<input type="Reset" value="Cancel">
	</form>
</body>
</html>