<?php
    $host="localhost";
    $database="school";
    $username="root";
    $password="strongpassword";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        echo "Connect failed: ". $e->getMessage();
    }
?>