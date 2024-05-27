<?php
// functions
require_once('../config/conn.php');
require_once('../functions.php');

require_once('../models/Models.php');
require_once('../models/Farmers.php');

// if ($_SERVER["REQUEST_METHOD"] != "POST") {
//     return json([
//         'message' => 'This page cannot be accessed through GET and PUT Request!'
//     ], 401);
// }

$token = bearer();