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
		<table id="DisplayTable">
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Function</th>
			</tr>
			</thead>
			<tbody>
			<?php
			require_once("../db_connection.php");
			$conn = openConnection();
			$id = $_SESSION['id'];
			$sql = "select * from patients where(insurerID = '$id');";
			$res = $conn->query($sql);
			if($res->num_rows>0){
			    while($row = $res->fetch_assoc()){
				$cID = $row["patientID"];
				$fName = $row["fName"];
				$lName = $row["lName"];
				echo '<tr>';
				echo '<td contenteditable="false">'.$cID.'</td>';
				echo '<td contenteditable="false">'.$fName.'</td>';
				echo '<td contenteditable="false">'.$lName.'</td>';
				echo '<td><input type="button" value="Remove" class="btn" onclick="deleteRow(this)"/></td>';
				echo '</tr>';
			    }
			}
			closeConnection($conn);
			?>
			</tbody>
		</table>
	
	
	


	</body>

</html>
