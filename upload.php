
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
	<form action="./Database/upload/store.php" method="post">
		<label for=title>Title:</label><br>
		<input type="text" name="title" id="title"><br><br>
		<label for=content>Desciption:</label><br>
		<textarea name="content" id="content"></textarea><br><br>
		<input type="Submit" value="Publish">
		<input type="Reset" value="Cancel">
	</form>
</body>
</html>