<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$password = $_REQUEST['appPassword'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "No ACCOUNT";
}
else{
    $row = $res->fetch_assoc();
    $id = $row["patientID"];
    $fName = $row["fName"];
    $lName = $row["lName"];
    $sql = "select * from passwords where(accountID = '$id' and password = '$password');";
    $res = $conn->query($sql);
    if($res->num_rows < 1){
	echo "PASS WRONG";
    }
    else{
	echo "PASS OK,$fName,$lName,$id";
    }
}
closeConnection($conn);
?>
