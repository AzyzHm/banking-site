<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "banking_website_project";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>