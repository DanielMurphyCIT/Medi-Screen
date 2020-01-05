<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en/ie">
		<head>
		<title>Doctor | Train AI</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="doctorStyle.css" />
		<link rel="stylesheet" href="aiTrainFormStyle.css" />

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
			<div id="ai-train-wrapper">


					<div id="HeartDiseaseFormWrapper">
						<form action="addHeartDiseaseData.php" id="HeartDiseaseForm" method="POST">
							<h2 id="heartTitle">Heart Disease</h2>
							<label>Age In Years : <br><input type="text" id="age" name="age"/></label><br><br>
							<label>Sex :<br> 1)Male<br>2)Female<br> <input type="text" id="sex" name="sex" /></label><br><br>
							<label>Chest Pain Type : <br>1. Typical Angina<br>2. Atypical Angina<br>3. Non-Anginal <br>4. Asymptomatic<br>
								<input type="text" id="chestPain" name="chestPain" /></label><br><br>
							<label>Resting Blood Pressure <br>on Admission:<br> <input type="text" id="bloodPressure" name="bloodPressure" /></label><br><br>
							<label>Serum Cholsetoral (mg/dl) : <br><input type="text" id="cholestoral" name="cholestoral" /></label><br><br>
							<label>Fasting Blood Pressure (120mg/dl) : <br>0 = False<br>1 = True<br><input type="text" id="fastingBP" name="fastingBP" /></label><br><br>
							<label>Resting Electrocradiographic Results <br>0 = Normal<br>1 = ST-T Wave Abnormality <br>2. = Showing left ventricular hypertrophy<br>
								<input type="text" id="RER" name="RER" /></label><br><br>
							<label>Maximum Heart Rate Achieved :<br><input type="text" id="maxHeartRate" name="maxHeartRate" /></label><br><br>
							<label>Excersize Induced Angina : <br>0 = No<br>1 = Yes<br><input type="text" id="inducedAngina" name="inducedAngina" /></label><br><br>
							<label>ST Depression Induced by <br>Excersize Relative To Rest : <br><input type="text" id="depressionInduced" name="depressionInduced" /></label><br><br>
							<label>Slope of Peak Excersize ST Segment : <br>1 = Upsloping<br>2 = flat<br>3 = downsloping<br><input type="text" id="slopeOfExcersize" name="slopeOfExcersize" /></label><br><br>
							<label>Number of Major Vessels (0-3) : <br><input type="text" id="majorVessels" name="majorVessels" /></label><br><br>
							<label>Thal : <br>3 = Normal<br>6 = Fixed Defect<br>7 = Reversable Defect<br><input type="text" id="thal" name="thal" /></label><br><br>
							<label>Diagnosis of Heart Disease<br>0 = <50% Diameter Narrowing<br>1 = >50% Diameter Narrowing<br><input type="text" id="diagnosis" name="diagnosis"/></label><br><br>
							<button>Train</button>
						</form>
					</div>
					<div id="BreastCancerFormWrapper">
						<form action="addBreastCancerData.php" id="BreastCancerForm" method="POST">
							<h2>Breast Cancer</h2>
							<label>Age In Years : <br><input type="text" id="age" name="age"/></label><br><br>
							<label>BMI : <br><input type="text" id="bmi" name="bmi"/></label><br><br>
							<label>Glucose Levels : <br><input type="text" id="glucose" name="glucose"/></label><br><br>
							<label>Insulin Dosage : <br><input type="text" id="insulin" name="insulin"/></label><br><br>
							<label>HOMA : <br><input type="text" id="homa" name="homa"/></label><br><br>
							<label>Lepti : <br><input type="text" id="lepti" name="lepti"/></label><br><br>
							<label>Adiponectin : <br><input type="text" id="adiponectin" name="adiponectin"/><br><br>
							<label>Resistin : <br><input type="text" id="resistin" name="resistin"/><br><br>
							<label>MCP.1 : <br><input type="text" id="mcp" name="mcp"/><br><br>
							<label>Classification : <br><input type="text" id="classification" name="classification"/><br><br>
							<button>Train</button>
						</form>
					</div>
				
					<div id="DiabetesFormWrapper">
						<form action="addDiabetesData.php" id="DiabetesForm" method="POST">
							<h2>Diabetes</h2>
							<label>No. Pregnancies : <br><input type="text" id="pregnancies" name="pregnancies"/></label><br><br>
							<label>Glucose Plasma (mm Hg) : <br><input type="text" id="glucosePlasma" name="glucosePlasma"/></label><br><br>
							<label>Blood Pressure : <br><input type="text" id="BloodPressure" name="bloodPressure"/></label><br><br>
							<label>Skin Thickness (biceps) (mm) : <br><input type="text" id="bicepThickness" name="bicepThickness"/></label><br><br>
							<label>Insulin (mu U/ml) : <br><input type="text" id="insulin" name="insulin"/></label><br><br>
							<label>BMI : <br><input type="text" id="diabetesBMI" name="bmi"/></label><br><br>
							<label>Diabetes Pedigree Function : <br><input type="text" id="diabetesPedigree" name="diabetesPedigree"/></label><br><br>
							<label>Age In Years : <br><input type="text" id="diabetesAge" name="diabetesAge"/></label><br><br>
							<label>Outcome Class Variable :<br>1 or 0 <br><input type="text" id="outcomeClassVariable" name="outcomeClassVariable"/></label><br><br>
							<button>Train</button>
						</form>
					</div>
			</div>
		</body>	
</html>
