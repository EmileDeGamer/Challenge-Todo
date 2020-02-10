<?php 
    $db = "todo";
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbport = "3306";

    try{
        $conn = new PDO("mysql:host=$dbhost;dbname=$db;port=$dbport", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    
?>