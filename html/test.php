<?php
if(isset($_POST["query"])){


    include "db_connection.php";
    echo "Getting Query from Mobile App";
    $in = $_REQUEST["query"];
    echo "query: ".$in."--++-- ";
    $conn = OpenConnection();
    if (mysqli_query($conn,$in)){
       echo "Data Entered <br>";
    }
    else{
       echo "Error: ".mysqli_error($conn)."<br>";
    }
    CloseConnection($conn);
    $conn = OpenConnection();
    $sql = "select * from patients";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
	    $fname = $row['fName'];
	    echo $fname."<br>";
        }
    }
    else{
    echo "no result found";
    }

    CloseConnection($conn);
}
//file_put_contents("post.txt", $_POST);
//        print_r($_REQUEST);
//        $name   = urldecode($_POST['name']);
//        $user   = urldecode($_POST['user']);
//        $email  = urldecode($_POST['email']);
//        $pass   = urldecode($_POST['pass']);
//
//        echo " ==== POST DATA =====
//        Name  : $name
//        Email : $email
//        User  : $user
//        Pass  : $pass";
?>

