<?php
session_start();
require_once('../db_connection.php');
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$conn = openConnection();
$sql = "select * from doctors where(email ='$email');";
$res = $conn->query($sql);
if($res->num_rows < 1){
    echo "No Account Registered with that email, please register first<br>";
    echo "<a href='doctorSignup.php'> Click here to Register </a>";
}
else{
    $row = $res->fetch_assoc();
    $id = $row["doctorID"];
    $fName = $row["fName"];
    $lName = $row["lName"];
    $sql = "select * from passwords where(accountID = '$id' and password = '$password');";
    $res = $conn->query($sql);
    if($res->num_rows < 1){
	echo "Sorry that password is wrong, please try again...<a href='doctorLogin.php'> Click Here to try again </a>";
    }
    else{
	$_SESSION['id'] = $id;
	$_SESSION['username'] = $fName." ".$lName;
	header("Location: doctorHome.php");
	exit;
    }
}
closeConnection($conn);
?>
