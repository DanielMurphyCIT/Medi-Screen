<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "NO MODELS";
}
else{
    while($row = $res->fetch_assoc()){
        $name = $row["modelName"];
        $accuracy = $row["accuracy"];
        echo "$name, $accuracy\n";
    }
}
closeConnection($conn);
?>
