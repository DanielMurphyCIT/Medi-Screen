<?php
session_start();
require_once("../db_connection.php");
$age = $_REQUEST['age'];
$sex = $_REQUEST['sex'];
$chestPain = $_REQUEST['chestPain'];
$bloodPressure = $_REQUEST['bloodPressure'];
$cholestoral = $_REQUEST['cholestoral'];
$fastingBP = $_REQUEST['fastingBP'];
$rer= $_REQUEST['RER'];
$maxHeartRate= $_REQUEST['maxHeartRate'];
$inducedAngina= $_REQUEST['inducedAngina'];
$depressionInduced= $_REQUEST['depressionInduced'];
$slopeOfExcersize= $_REQUEST['slopeOfExcersize'];
$majorVessels= $_REQUEST['majorVessels'];
$thal= $_REQUEST['thal'];
$diagnosis= $_REQUEST['diagnosis'];
$arrayOfValues = [$age, $sex, $chestPain, $bloodPressure, $cholestoral, $fastingBP, $rer, $maxHeartRate, $inducedAngina, $depressionInduced, $slopeOfExcersize, $majorVessels, $thal, $diagnosis];
function checkInput($varArray){
    $nonNumericCount = 0;
    foreach($varArray as $value){
	if(!is_numeric($value)){
	    $nonNumericCount = $nonNumericCount + 1;
	}
    }
    return $nonNumericCount;
}
$wrongVals = checkInput($arrayOfValues);
if($wrongVals == 0){
    $dataString  = "";
    foreach($arrayOfValues as $value){
	$dataString = $dataString.$value.",";
    }
    $dataString  = substr_replace($dataString,"\n",-1);
    file_put_contents('/home/Medi-AI/Datasets/Heart Disease/processed.cleveland.data', $dataString, FILE_APPEND | LOCK_EX);
    $sql = "update datasetUpdates set updated = 1 where name = 'heartDisease';";
    $conn = openConnection();
    if(mysqli_query($conn, $sql)){
        header("Location: doctorTrain.php");
    }
    else{
        echo "The data has been saved to the dataset <br>However an error has occured updating the database to retrain the machine learning model <br>";
	echo "Please contact your admin/IT department with this error: ".mysqli_error($conn); 
	echo "<a href='doctorTrain.php'><b>click Here to go back</b></a>";
    }
    closeConnection($conn);
}
else{
    echo "There are ".checkInput($arrayOfValues)." non numeric values entered, please check the data you submitted and try again <a href='doctorTrain.php'><b>Click Here</b></a> to resubmit data";
}
?>
