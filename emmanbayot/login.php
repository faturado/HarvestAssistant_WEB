<?php
header('Content-Type: application/json');

// Enable error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection
include 'conn.php';

// Get the post data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Extract the data
$rsbsa_num = isset($data['rsbsa_num']) ? trim($data['rsbsa_num']) : '';
$password = isset($data['password']) ? trim($data['password']) : '';

// Check if any required fields are empty
if (empty($rsbsa_num) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required'
    ]);
    exit();
}

// Initialize the Farmers model
$farmer = new Farmers();
$info = $farmer->where(['rsbsa_num' => $rsbsa_num])->get();

if (!$info) {
    echo json_encode([
        'success' => false,
        'message' => 'User not found!',
        'status' => 'invalid'
    ]);
    exit();
}

$info = $info[0];

// Check if the password matches
if ($info['password'] != $password) {
    echo json_encode([
        'success' => false,
        'message' => 'Password mismatch!',
        'status' => 'invalid'
    ]);
    exit();
}

// Generate token and current date
$token = md5(rand());
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

$user_id = $info['id'];

// Check if the user already has a token
$checkUser = $conn->prepare('SELECT * FROM farmer_tokens WHERE farmer_id = ?');
$checkUser->bind_param("i", $user_id);
$checkUser->execute();
$checkUser = $checkUser->get_result()->fetch_assoc();

// Insert or update the token
if (!$checkUser) {
    $stmt = $conn->prepare('INSERT INTO farmer_tokens(farmer_id, remember_token, date_login) VALUES(?,?,?)');
    $stmt->bind_param("iss", $user_id, $token, $date);
    $stmt->execute();
} else {
    $stmt = $conn->prepare('UPDATE farmer_tokens SET remember_token = ?, date_login = ? WHERE farmer_id = ?');
    $stmt->bind_param("ssi", $token, $date, $user_id);
    $stmt->execute();
}

// Return success response with the token
echo json_encode([
    'success' => true,
    'message' => 'Login Successfully',
    'remember_token' => $token
], 201);

$stmt->close();
$conn->close();
?>
