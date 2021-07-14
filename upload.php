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
	<link rel="stylesheet" type="text/css" href="./CSS/style_index.css">
	<link rel="icon" href="./images/fav.ico" />
	<meta name="viewport" content="width=device-width">
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
	<div id="upload">
		<div id="header"><label>Upload</label></div><br>
		<form action="./Database/articles/store.php" method="post" enctype="multipart/form-data">
			<input type="text" name="title" id="title" placeholder="Title" required><br><br>
			<textarea name="content" id="content" placeholder="Content" onkeyup="do_resize(this);" rows=2 required></textarea>
			<br><br>
			<input type="file" name="images[]" id="file" multiple="multiple">
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