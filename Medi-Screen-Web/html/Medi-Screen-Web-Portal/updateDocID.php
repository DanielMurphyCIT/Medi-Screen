<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if(mysqli_query($conn, $query)){
    echo "DONE";
}
else{
    echo "Error".mysqli_error($conn);
}
closeConnection($conn);
?>
