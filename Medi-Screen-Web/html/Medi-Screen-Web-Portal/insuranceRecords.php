<?php
session_start();
if(isset($_POST['Submit'])){
    $_SESSION['cID'] = $_POST['id'];
}
?>
<!DOCTYPE html>
<html lang="eng/ie">
	<head>
		<title>Insurance | Records</title>
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
	<div id="main-body-wrapper">
		<div id="patientRecordForm">
		<p class="form-title">Find Insurance File</p>
			<form action = "" method="POST">
				<input class="Patient-Record-Input" name="id" type="username" placeholder="Client ID" />
				<button name="Submit" id="Patient-Record-Button">Submit</button>
			</form>
		</div>
		<div id="Client-Record-Display">
		<?php
		require_once("../db_connection.php");
		$conn = openConnection();
		$id = $_SESSION['id'];
		$cID = $_SESSION['cID'];
		$sql = "Select * from patients where (patientID = '$cID' and insurerID = '$id');";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$fName = $row['fName'];
		$lName = $row['lName'];
		$sql = "Select * from predictions where (patientID = '$cID');";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
		$risk = 0;
		$heartDisease = $row['heartDisease'];
		$hString = "Undefined";
		if($heartDisease == 0){
		    $hString = "Negative";
		}
		elseif($heartDisease != ""){
		    $risk = $risk + 1;
		    $hString = "Severity Level ".$heartDisease;
		}
		$diabetes = $row['diabetes'];
		$dString = "Undefined";
		if ($diabetes == 0){
		    $dString = "Negative";
		}
		elseif ($diabetes == 1){
		    $dString = "Positive";
		    $risk = $risk + 1;
		}
		$breastCancer = $row['breastCancer'];
		$bString = "Undefined";
		if ($breastCancer == 0){
		    $bString = "Negative";
		}
		elseif ($breastCancer == 1){
		    $bString = "Positive";
		    $risk = $risk + 1;
		}
		closeConnection($conn);
		if(isset($_POST['Submit'])){
		    echo '<label class="display-labels"> Risk Level: &nbsp Level '.$risk.'</label><br><br>';
		    echo '<label class="display-labels">First Name :&nbsp'.$fName.' </label><br><br>';
		    echo '<label class="display-labels">Last Name :&nbsp'.$lName.' </label><br><br>';
		    echo '<label class="display-labels">Age : </label><br><br>';
		    echo '<label class="display-labels">Address :</label><br><br>';
		    echo '<label class="display-labels">Client ID :&nbsp'.$cID.' </label><br><br>';
		    echo '<label class="display-labels">Premium € : </label><br><br>';
		    echo '<label class="display-labels">PPS NO. : </label><br><br>';
		    echo '<label class="display-labels">Heart Disease Result:&nbsp'.$hString.'</label><br><br>';
		    echo '<label class="display-labels">Diabetes Result:&nbsp'.$dString.'</label><br><br>';
		    echo '<label class="display-labels">Breast Cancer Result:&nbsp'.$bString.'</label><br><br>';
		}
		else{
		    echo '<label class="display-labels">Please enter the id of the client you want to see above.</label><br><br>';
		}
		closeConnection($conn);
		?>
		</div>
	</div>
	</body>
</html>
