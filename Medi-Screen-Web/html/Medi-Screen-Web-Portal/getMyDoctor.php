<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "No Doctor";
}
else{
    $row = $res->fetch_assoc();
    $id = $row["doctorID"];
    echo "FOUND DOC, $id";
}
closeConnection($conn);
?>
