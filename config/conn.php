<?php
    $host = "localhost";
    $username = "faturado";
    $password = "harvestassistant";
    $dbname = "agri_db";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }catch(Exception $e){
        die("Error Message: " .  $e->getMessage());
    }