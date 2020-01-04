<?php
session_start();
require_once('../db_connection.php');
$fName = "";
$fName = $_REQUEST["fName"];
$lName = $_REQUEST["lName"];
$companyName = $_REQUEST["companyName"];
$postCode = $_REQUEST["postCode"];
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
if($fName == ""){
   echo "ERROR: Data has not been sent from the register form, please try again<br>";
   echo "<a href='insurerSignup.php' Click to go back >";
}
else{
//Start Connection to database
$conn = openConnection();
$query = "Select * from insurers where(email = '$email');";
$res = $conn->query($query);
if($res->num_rows > 0){
    echo 'There is already an account registered with that email, please login';
}
else{
    $query = "INSERT INTO insurers(fName, lName, email, companyName, postCode) Values ('$fName','$lName','$email','$companyName','$postCode');";
    if (mysqli_query($conn,$query)){
        echo "Data Sent Successfully"."<br><br>";
	$newQuery = "select * from insurers where(email = '$email');";
	$newResult = $conn->query($newQuery);
	$row = $newResult->fetch_assoc();
	$id = $row['insurerID'];
	echo "the account id we will use is $id";
	$newQuery = "insert into passwords(accountID, password) values ('$id','$password');";
	if(mysqli_query($conn,$newQuery)){
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $fName." ".$lName;
		header( "Location: insuranceHome.php" );
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


