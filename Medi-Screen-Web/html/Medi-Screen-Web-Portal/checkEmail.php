<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "ACCOUNT OK";
}
else{
    echo "EXISTS";
}
closeConnection($conn);
?>
