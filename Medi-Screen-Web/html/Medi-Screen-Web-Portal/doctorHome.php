<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eng/ie">
	<head>
		<title>Doctor | Home</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="doctorStyle.css" />
	</head>
	<header>
		<nav id="main-nav">
			<ul id="main-ul">
				<li class="main-li"><a class="main-a" href="doctorHome.php">HOME</a></li>
				<li class="main-li"><a class="main-a" href="doctorRecords.php">RECORDS</a></li>
				<li class="main-li"><a class="main-a" href="doctorPatients.php">PATIENTS</a></li>
				<li id="logo"><a id="logo-a" href="doctorHome.php">MEDI-SCREEN</a></li>
				<li style="float:right" class="account-li"><a class="account-a" href="doctorTrain.php">ADMIN </a></li>
				<li style="float:right" class="account-li"><a class="account-a" href="logout.php">LOG OUT</a></li>
				<?php
				$username = $_SESSION['username'];
				echo '<li style="float:right" class="account-li"><a class="account-a" href="doctorAccount.php">'.$username.'</a></li>';
				?>

			</ul>
		</nav>


	</header>
	<body>
		<div>
			<a href="" id="register-patient-button">Welcome...</a>
		</div>
		<div id="home-body-wrapper">
			<p class="main-body">Welcome to the Doctor section of the Medi-Screen Web app <br>
			Here you can: <br> 1) Search for a specific patient and their details<br>
			2) You can see all of your patients <br> 3) You can see your account details <br>
			4) You can use the admin tab to input more data to the datasets, and retrain the Medi-AI models<br> </p>
		<ul>
		<h3>Accuracy of the Machine Learning Models</h3>
		<?php
		require_once('../db_connection.php');
		$query = "Select * from models;";
		$conn = openConnection();
		$res = $conn->query($query);
		if($res->num_rows < 1){
    			echo "NO MODELS";
		}
		else{
    			while($row = $res->fetch_assoc()){
        			$name = $row["modelName"];
        			$accuracy = $row["accuracy"];
        			echo "<li><h4>$name: $accuracy</h4></li><br>";
    			}
		}
		closeConnection($conn);
		?>
		</ul>
		</div>
	</body>



</html>
