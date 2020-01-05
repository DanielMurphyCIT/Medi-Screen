<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
if(mysqli_query($conn,$query)){
    echo "DONE";
}
else{
    echo "ERROR".mysqli_error($conn);
}
closeConnection($conn);
?>
