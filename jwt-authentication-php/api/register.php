<?php
include_once './config/database.php';

header('Access-Control-Allow-Origin: *'); //you can changed to '*'.
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");

$firstName = '';
$lastName = '';
$email = '';
$password = '';
$conn = null;

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$firstName = $data->first_name;
$lastName = $data->last_name;
$email = $data->email;
$password = $data->password;

$table_name = 'users';

$query = "INSERT INTO " . $table_name . "
                SET name = :firstname,
                    prename = :lastname,
                    email = :email,
                    password = :password";

$stmt = $conn->prepare($query);

$stmt->bindParam(':firstname', $firstName);
$stmt->bindParam(':lastname', $lastName);
$stmt->bindParam(':email', $email);

$password_hash = password_hash($password, PASSWORD_BCRYPT);

$stmt->bindParam(':password', $password_hash);


if ($stmt->execute()) {

    http_response_code(200);
    echo json_encode(["message" => "User was successfully registered!"]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Unable to register the user!"]);
}
