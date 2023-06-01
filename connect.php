<?php
    $host = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "fcms";

    //$connection = new mysqli($host,$dbuser,$dbpassword,$dbname);

    $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>