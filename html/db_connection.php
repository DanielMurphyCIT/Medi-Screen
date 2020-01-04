<?php

function openConnection(){

    $dbHost = "localhost";
    $dbUser = "ubuntu";
    $dbPass = "root";
    $db = "mediScreenDatabase";
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}

function closeConnection($conn){
    $conn -> close();
}
?>
