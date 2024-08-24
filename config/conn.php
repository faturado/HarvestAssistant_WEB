<?php
    $host = "srv1322.hstgr.io";
    $username = "u766798681_dbHarvest";
    $password = "EmmanBayot_69";
    $dbname = "u766798681_adminHarvest";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }catch(Exception $e){
        die("Error Message: " .  $e->getMessage());
    }