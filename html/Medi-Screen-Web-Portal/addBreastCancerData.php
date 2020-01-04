<?php
session_start();
require_once("../db_connection.php");
$age = $_REQUEST['age'];
$bmi = $_REQUEST['bmi'];
$glucose = $_REQUEST['glucose'];
$insulin = $_REQUEST['insulin'];
$homa = $_REQUEST['homa'];
$lepti = $_REQUEST['lepti'];
$adiponectin= $_REQUEST['adiponectin'];
$resistin= $_REQUEST['resistin'];
$mcp= $_REQUEST['mcp'];
$diagnosis= $_REQUEST['classification'];
$arrayOfValues = [$age, $bmi, $glucose, $insulin, $homa, $lepti, $adiponectin, $resistin, $mcp, $diagnosis];
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
    file_put_contents('/home/Medi-AI/Datasets/BreastCancerCoimbraDataSet.csv', $dataString, FILE_APPEND | LOCK_EX);
    $sql = "update datasetUpdates set updated = 1 where name = 'breastCancer';";
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
