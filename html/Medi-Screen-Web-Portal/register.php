<?php
session_start();
require_once('../db_connection.php');
$fName = "";
$fName = $_REQUEST["fName"];
$lName = $_REQUEST["lName"];
$location = $_REQUEST["location"];
$postCode = $_REQUEST["postCode"];
$email = $_REQUEST["email"];
$phoneNum = $_REQUEST["phone"];
$password = $_REQUEST["password"];
if($fName == ""){
   echo "ERROR: Data has not been sent from the register form, please try again<br>";
   echo "<a href='doctorSignup.php' Click to go back >";
}
else{
//Start Connection to database
$conn = openConnection();
$query = "Select * from doctors where(email = '$email');";
$res = $conn->query($query);
if($res->num_rows > 0){
    echo 'There is already an account registered with that email, please login';
}
else{
    $query = "INSERT INTO doctors(fName, lName, location, postCode, email, phoneNum) Values ('$fName','$lName','$location','$postCode','$email', '$phoneNum');";
    if (mysqli_query($conn,$query)){
        echo "Data Sent Successfully"."<br><br>";
	$newQuery = "select * from doctors where(email = '$email');";
	$newResult = $conn->query($newQuery);
	$row = $newResult->fetch_assoc();
	$id = $row['doctorID'];
	echo "the account id we will use is $id";
	$newQuery = "insert into passwords(accountID, password) values ('$id','$password');";
	if(mysqli_query($conn,$newQuery)){
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $fName." ".$lName;
		header( "Location: doctorHome.php" );
		exit ;
	}
	else{
		echo "Error Storing Password: $newQuery ".mysqli_error($conn)."<br>";
	}
    }
    else{
	echo "ERROR: Could not able to execute $query. " . mysqli_error($conn)."<br><br>";
    }
}
closeConnection($conn);
}


?>


