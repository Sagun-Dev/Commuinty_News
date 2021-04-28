<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<form action="./Database/user/register.php" method="post">
		<label for=fname>First Name: </label>
		<input type="text" name="fname" id="fname" required>
		<br><br>
		<label for=l_name>Last Name: </label>
		<input type="text" name="lname" id="lname" required>
		<br><br>
		<label for=dob>DOB: </label>
		<input type="date" name="dob" id="dob" required>
		<br><br>
		<label>Gender: </label><br>
		<input type="radio" name="gender" value="male" id="male" required>
		<label for="male">Male</label><br>
		<input type="radio" name="gender" value="female" id="female" required>
		<label for="female">Female</label><br>
		<input type="radio" name="gender" value="other" id="other" required>
		<label for="other">Other</label><br>
		<br><br>
		<label for=email>Email: </label>
		<input type="email" name="email" id="email" required>
		<br><br>
		<label for=password>Password: </label>
		<input type="password" name="password" id="password" required>
		<label id="warning"></label>
		<br><br>
		<input type="submit" value="Register">
		<input type="reset">
	</form>
</body>
</html>