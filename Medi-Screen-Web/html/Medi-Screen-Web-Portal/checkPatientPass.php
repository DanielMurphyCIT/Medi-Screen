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
    $sql = "insert into passwords(accountID, password) values('$id', '$password');";
    if(mysqli_query($conn, $sql)){
        echo "PASS OK, $id";
    }
    else{
        echo "ERROR ,".mysqli_error($conn);
    }
}
closeConnection($conn);
?>
