<!DOCTYPE html>
<html lang="eng/ie">
	<head>
		<title>Insurer Register Portal</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="form.css" />
		<script src="checkPass.js">
		</script>
	</head>
	<body>
	<div class="form-container sign-in-container">
		<a href="../index.html" id="homeButton"> << BACK</a>

		<form action="registerInsurance.php" onsubmit="return passCheck()" method="POST">
			<h1>INSURER REGISTER PORTAL</h1>
			<div class="social-container">
				<a href="#" class="social"><image id="fb" src="images/facebook.png" /></a>
				<a href="#" class="social"><image id="twitter" src="images/twitter.png" /></a>
				<a href="#" class="social"><image id="googleplus" src="images/googleplus.png" /></a>
			</div>
			<span>or register</span>
			<p id="error"></p>
			<input type="text" name="fName" placeholder="First Name" required />
			<input type="text" name="lName" placeholder="Last Name" />
			<input type="text" name="companyName" placeholder="Company Name" required />
			<input type="text" name="postCode" placeholder="Company Post Code" required />
			<input type="email" name="email" placeholder="Email" required />
			<input type="password" name="password" placeholder="Password" id="password" required />
			<input type="password" placeholder="Confirm Password" id="confirm_password" required />
			<button type="submit">Register</button>
		</form>





		</div>
	</body>






</html>
