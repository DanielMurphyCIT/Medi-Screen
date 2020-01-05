<?php
session_start();
if(isset($_POST['Submit'])){
    $_SESSION['pID'] = $_POST['id'];
    echo $_SESSION['pID'];
}
?>
<!DOCTYPE html>
<html lang="eng/ie">
	<head>
		<title>Doctor | Records</title>
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
				<li style="float:right" class="account-li"><a class="account-a" href="doctorTrain.php">ADMIN</a></li>
				<li style="float:right" class="account-li"><a class="account-a" href="logout.php">LOG OUT</a></li>
				<?php
				$username = $_SESSION['username'];
				echo '<li style="float:right" class="account-li"><a class="account-a" href="doctorAccount.php">'.$username.'</a></li>';
				?>

			</ul>
		</nav>


	</header>
	<body>
	<div id="main-body-wrapper">
		<div id="patientRecordForm">
		<p class="form-title">Find Patient Record</p>
			<form action="" method="POST">
				<input class="Patient-Record-Input" name="id" type="username" placeholder="Patient ID" />
				<button id="Submit" name="Submit">Submit </button>
			</form>
		</div>
		<div id="Patient-Record-Display">
		<?php
		require_once("../db_connection.php");
		$conn = openConnection();
		$id = $_SESSION['id'];
		$pID = $_SESSION['pID'];
		$sql = "Select * from patients where(patientID = '$pID' and doctorID = '$id');";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$fName = $row['fName'];
		$lName = $row['lName'];
		$sql = "select * from predictions where(patientID = '$pID');";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$heartDisease = $row['heartDisease'];
		$hString = "Undefined";
		if($heartDisease === 0){
		    $hString = "Negative";
		}
		elseif($heartDisease != ""){
		    $hString = "Severity Level ".$heartDisease;
		}
		$diabetes = $row['diabetes'];
		$dString = "Undefined";
		if($diabetes == 0){
		    $dString = "Negative";
		}
		elseif($diabetes == 1){
		    $dString = "Positive";
		}
		$breastCancer = $row['breastCancer'];
		$bString = "Undefined";
		if($breastCancer == 0){
		    $bString = "False";
		}
		elseif($breastCancer == 1){
		    $bString = "Positive";
		}
		closeConnection($conn);
		if(isset($_POST['Submit'])){
		echo '<label class="display-labels">First Name :&nbsp'.$fName.' </label><br><br>';
		echo '<label class="display-labels">Last Name :&nbsp'.$lName.' </label><br><br>';
		echo '<label class="display-labels">Age :&nbsp </label><br><br>';
		echo '<label class="display-labels">Patient ID :&nbsp'.$pID.' </label><br><br>';
		echo '<label class="display-labels">Primary Illness :&nbsp </label><br><br>';
		echo '<label class="display-labels">Medications :&nbsp </label><br><br>';
		echo '<label class="display-labels">Symptoms :&nbsp </label><br><br>';
		echo '<label class="display-labels">Heart Disease Result :&nbsp'.$hString.' </label><br><br>';
		echo '<label class="display-labels">Diabetes Result :&nbsp'.$dString.' </label><br><br>';
		echo '<label class="display-labels">Breast Cancer Result :&nbsp'.$bString.' </label><br><br>';
		}
		else{
		echo '<label class="display-labels">Please enter the id above to find a patients details</label><br><br>';
		}
		?>
		</div>
	</div>
	</body>
</html>
