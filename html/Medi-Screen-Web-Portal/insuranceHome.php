<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en/ie">


	<head>
		<title>Insurance | Home</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="doctorStyle.css" />
	</head>
	<header>
		<nav id="main-nav">
			<ul id="main-ul">
				<li class="main-li"><a class="main-a" href="insuranceHome.php">HOME</a></li>
				<li class="main-li"><a class="main-a" href="insuranceRecords.php">RECORDS</a></li>
				<li class="main-li"><a class="main-a" href="insuranceClients.php">CLIENTS</a></li>
				<li id="logo"><a id="logo-a" href="insuranceHome.php">MEDI-SCREEN</a></li>
				<li style="float:right" class="account-li"><a class="account-a" href="../index.html">LOG OUT</a></li>
				<?php
				$username = $_SESSION['username'];
				echo '<li style="float:right" class="account-li"><a class="account-a" href="insurerAccount.php">'.$username.'</a></li>';
				?>

			</ul>
		</nav>


	</header>
	<body>
		<div>
			<a href="" id="register-patient-button">Welcome...</a>
		</div>
		<div id="home-body-wrapper">
			<p class="main-body">Welcome to the Insurance Section of the Medi-Screen Web App<br>
			From here you can: <br>1) You can search for a specific client and generate a report<br>
			2)You can see all of your clients<br>
			3) You can see your account details<br></p>
		</div>
		
	</body>







</html>
