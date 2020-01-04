<!DOCTYPE html>
<html lang="eng/ie">
	<head>
		<title>Medical Staff Register Portal</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="form.css" />
		<script src="checkPass.js">
		</script>
	</head>
	<body>
	<div class="form-container sign-in-container">
		<a href="../index.html" id="homeButton"> << BACK</a>

		<form action="register.php" onsubmit="return passCheck()"  method="POST">
			<h1>MEDICAL STAFF REGISTER PORTAL</h1>
			<div class="social-container">
				<a href="#" class="social"><image id="fb" src="images/facebook.png" /></a>
				<a href="#" class="social"><image id="twitter" src="images/twitter.png" /></a>
				<a href="#" class="social"><image id="googleplus" src="images/googleplus.png" /></a>
			</div>
			<span>or register</span>
			<p id="error"></p>
			<input type="text" placeholder="First Name" name="fName" required />
			<input type="text" placeholder="Last Name" name="lName" required />
			<input type="text" placeholder="Practice Name" name="location"  required />
			<input type="text" placeholder="Practice Post Code" name="postCode" required />
			<input type="email" placeholder="Email" name="email" required />
			<input type="text" placeholder="Contact Number" name="phone" required />
			<input type="password" placeholder="Password" id="password" name="password" required />
			<input type="password" placeholder="Confirm Password" id="confirm_password" required />
			<input type="submit" name="Register">
		</form>





		</div>
	</body>






</html>
