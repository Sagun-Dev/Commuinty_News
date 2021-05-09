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
	<link rel="stylesheet" type="text/css" href="./CSS/upload.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
<div id="out">
	<div id="upload">
		<div id="header"><label>Upload</label></div><br>
		<form action="./Database/articles/store.php" method="post" enctype="multipart/form-data">
			<input type="text" name="title" id="title" placeholder="Title" required><br><br>
			<textarea name="content" id="content" placeholder="Content" onkeyup="do_resize(this);" rows=2 required></textarea>
			<br><br>
			<input type="file" name="images[]" id="file" multiple>
			<input type="Submit" value="Publish" id="submit"><br>
			<input type="Reset" value="Cancel" id="reset" onclick="revert()">
		</form>
	</div>
</div>
<script type="text/javascript">
function do_resize(textbox) {
	var maxrows=50; 
	var txt=textbox.value;
	var cols=textbox.cols;
	var arraytxt=txt.split('\n');
	var rows=arraytxt.length; 
	for (i=0;i<arraytxt.length;i++) 
		rows+=parseInt(arraytxt[i].length/cols);
	if (rows>maxrows) textbox.rows=maxrows;
		else textbox.rows=rows;
}
function revert(){
	document.getElementById("content").rows = "2";
}
</script>
</body>
</html>