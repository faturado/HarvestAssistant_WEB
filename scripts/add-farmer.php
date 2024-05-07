<?php

include '../config/conn.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die('This page cannot be accessed through GET and PUT Request!');
}

$rsbsa_num = $_POST['rsbsa_num'];
$fname = $_POST['fname'];
$mname = $_POST['mname'] ?? '';
$lname = $_POST['lname'] ?? '';
$crops = $_POST['crop'];
$area = $_POST['area'];
$barangay = $_POST['barangay'];
$contact = $_POST['contact'];
$password = $_POST['password'];

$sql = "SELECT * FROM `farmers` WHERE rsbsa_num= ?";
$checkUser = $conn->prepare($sql);
$checkUser->execute([$rsbsa_num]);

if ($checkUser->fetch()) {
    $_SESSION['error_message'] = 'User exists!';
    header('Location: ../farmers.php');
    exit();
}

$sql = "INSERT INTO `farmers` (rsbsa_num, password, first_name, middle_name, last_name, contact_number, area, crops, barangay, role) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$rsbsa_num, $password, $fname, $mname, $lname, $contact, $area, $crops, $barangay, '1']);

$_SESSION['success_message'] = 'Successfully added farmers!';
header('Location: ../farmers.php');
exit();
