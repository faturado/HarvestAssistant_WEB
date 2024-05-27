<?php

require_once('../functions.php');

if ($_SERVER["REQUEST_METHOD"] != "GET") {
    return json([
        'message' => 'This page cannot be accessed through POST and PUT Request!'
    ], 401);
}

$token = bearer();

return json([
    $token
]);

return json([
    "message" => "hi"
], 200);