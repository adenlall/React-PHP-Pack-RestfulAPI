<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'connect.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->id)
    && isset($data->user_name)
    && isset($data->user_email)
    && is_numeric($data->id)
    && !empty(trim($data->user_name))
    && !empty(trim($data->user_email))
) {
    $username = mysqli_real_escape_string($db_conn, trim($data->user_name));
    $useremail = mysqli_real_escape_string($db_conn, trim($data->user_email));
    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $updateUser = mysqli_query($db_conn, "UPDATE `users` SET `user_name`='$username', `user_email`='$useremail' WHERE `id`='$data->id'");
        if ($updateUser) {
            echo json_encode(["success" => 1, "msg" => "User Updated."]);
        } else {
            echo json_encode(["success" => 0, "msg" => "User Not Updated!"]);
        }
    } else {
        echo json_encode(["success" => 0, "msg" => "Invalid Email Address!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}