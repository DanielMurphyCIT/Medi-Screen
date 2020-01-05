<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en/ie">
		<head>
		<title>Doctor | Patients</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="doctorStyle.css" />
		<script type="text/javascript">

			function deleteRow(r) {
			  var i = r.parentNode.parentNode.rowIndex;
			  document.getElementById("patientsDisplayTable").deleteRow(i);
			}
			

		</script>
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
		<table id="DisplayTable">
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Function</th>
			</tr>
			</thead>
			<?php
			require_once('../db_connection.php');
			$id = $_SESSION['id'];
			$sql = "select * from patients where(doctorID = '$id');";
			$conn = openConnection();
			$res = $conn->query($sql);
			echo "<tbody>";
			if ($res->num_rows > 0){
			    while($row = $res->fetch_assoc()){
				$pID = $row["patientID"];
				$fName = $row["fName"];
				$lName = $row["lName"];
				echo '<tr>';
				echo '<td contenteditable="false">'.$pID.'</td>';
				echo '<td contenteditable="false">'.$fName.'</td>';
				echo '<td contenteditable="false">'.$lName.'</td>';
				echo '<td><input type="button" value="Remove" class="btn" onclick="deleteRow(this)"/></td>';
				echo '</tr>';
			    }
			}
			?>
			</tbody>
		</table>
	
	
	


	</body>

</html>
