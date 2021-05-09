<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="./CSS/signup.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	<div id="out">
		<div id="signup">
			<form action="./Database/users/register.php" method="post" enctype="multipart/form-data">
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
				<label for="male">Male</label><br>
				<input type="radio" name="gender" value="female" id="female" required>
				<label for="female">Female</label><br>
				<input type="radio" name="gender" value="other" id="other" required>
				<label for="other">Other</label><br>
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
</body>
</html>