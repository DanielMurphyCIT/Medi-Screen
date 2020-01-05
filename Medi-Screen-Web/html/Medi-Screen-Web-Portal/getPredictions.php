<?php
require_once('../db_connection.php');
$query = $_REQUEST['appQuery'];
$conn = openConnection();
$res = $conn->query($query);
if($res->num_rows < 1){
    echo "ERROR	";
}
else{
    $row = $res->fetch_assoc();
    $heartDisease = $row["heartDisease"];
    $diabetes = $row["diabetes"];
    $breastCancer = $row["breastCancer"];
    $hString = "Undefined";
    if($heartDisease === 0){
        $hString = "Negative";
    }
    elseif($heartDisease != ""){
        $hString = "Severity Level ".$heartDisease;
    }
    $diabetes = $row['diabetes'];
    $dString = "Undefined";
    if($diabetes == 0){
        $dString = "Negative";
    }
    elseif($diabetes == 1){
        $dString = "Positive";
    }
    $breastCancer = $row['breastCancer'];
    $bString = "Undefined";
    if($breastCancer == 0){
        $bString = "False";
    }
    elseif($breastCancer == 1){
        $bString = "Positive";
    }
    echo "$hString,$dString,$bString";

}
closeConnection($conn);
?>
