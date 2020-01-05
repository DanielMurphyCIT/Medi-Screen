<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "No Doctors";
}
else{
    while($row = $res->fetch_assoc()){
    	$id = $row["doctorID"];
    	$fName = $row["fName"];
    	$lName = $row["lName"];
    	$email = $row["email"];
    	$phoneNum = $row["phoneNum"];
    	$location = $row["location"];
    	$postCode = $row["postCode"];
        echo "$id,$fName,$lName,$email,$phoneNum,$location,$postCode\n";
    }
}
closeConnection($conn);
?>
