<?php
    // Uncomment Here
    // $host = "localhost";
    // $username = "root";
    // $password = "harvestassistant";
    // $dbname = "agri_db";

    // Comment Here
    $host = "mysql";
    $username = "danny";
    $password = "dan123";
    $dbname = "agri_db";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }catch(Exception $e){
        die("Error Message: " .  $e->getMessage());
    }