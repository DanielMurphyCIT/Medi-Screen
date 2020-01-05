<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eng/ie">
		<head>
		<title>Edit Account</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="doctorStyle.css" />
		<link rel="stylesheet" href="accountStyle.css" />
		<script type="text/javascript">
		var fileTag = document.getElementById("upload"),
			preview = document.getElementById("profile-pic");
			
		fileTag.addEventListener("change", function() {
		  changeImage(this);
		});

		function changeImage(input) {
		  var reader;

		  if (input.files && input.files[0]) {
			reader = new FileReader();

			reader.onload = function(e) {
			  preview.setAttribute('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		  }
		}
		
		
		</script>
	</head>
	<header>
		<nav id="main-nav">
			<ul id="main-ul">
				<li class="main-li"><a class="main-a" href="insuranceHome.php">HOME</a></li>
				<li class="main-li"><a class="main-a" href="insuranceRecords.php">RECORDS</a></li>
				<li class="main-li"><a class="main-a" href="insuranceClients.php">CLIENTS</a></li>
				<li id="logo"><a id="logo-a" href="insuranceHome.php">MEDI-SCREEN</a></li>
				<li style="float:right" class="account-li"><a class="account-a" href="logout.php">LOG OUT</a></li>
				<?php
				$username = $_SESSION['username'];
				echo '<li style="float:right" class="account-li"><a class="account-a" href="insurerAccount.php">'.$username.'</a></li>';
				?>

			</ul>
		</nav>


	</header>
	<body>
	<form action="InsuranceHome.php">
		<div id="form">
			<image src="profile-pic.png" id="profile-pic" /><br>
			<input type="file" id="upload"/>
			<?php
			require_once("../db_connection.php");
			$conn = openConnection();
			$id = $_SESSION['id'];
			$sql = "Select * from insurers where(insurerID = '$id');";
			$res = $conn->query($sql);
			$row = $res->fetch_assoc();
			$fName = $row['fName'];
			$lName = $row['lName'];
			$email = $row['email'];
			$companyName = $row['companyName'];
			$postCode = $row['postCode'];
			echo '<p id="username">&nbsp'.$fName." ".$lName.'</p>';
			echo '<div id="details">';
			echo '<label>First Name:&nbsp'.$fName.'</label><br><br>';
			echo '<label>Last Name:&nbsp'.$lName.'</label><br><br>';
			echo '<label>Email Address:&nbsp'.$email.'</label><br><br>';
			echo '<label>Company Name:&nbsp'.$companyName.' </label><br><br><br>';
			echo '<label>Company Post Code:&nbsp'.$postCode.'</label><br><br>';
			echo '<label>Contact Number:</label>';
			?>
			</div>
		</div>
			<div id="info">
			</div>
	</form>

	</body>

</html>
