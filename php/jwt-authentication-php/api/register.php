<?php
include_once './config/database.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/*
    TODO: change If to Ifelse.
*/


$data = json_decode(file_get_contents("php://input"));


$firstName = '';
$lastName = '';
$email = '';
$password = '';
$conn = null;

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (
    isset($data->fname) && isset($data->lname) && isset($data->email) && isset($data->pass)
) {

    $firstName = trim($data->fname);
    $lasttName =  trim($data->lname);
    $email =  trim($data->email);
    $password =  trim($data->pass);
    if (filter_var($firstName, FILTER_SANITIZE_STRING)) {
        if (filter_var($lasttName, FILTER_SANITIZE_STRING)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $query = "INSERT INTO users (name, prename, email, password) VALUES ('$firstName', '$lasttName', '$email', '$password_hash')";
                if ($db_conn->query($query) === TRUE) {
                    echo json_encode(["success" => true, "status" => "User Inserted.", 'response' => 200]);
                } else {
                    echo json_encode(["success" => false, "status" => "Unable to register the user!", 'response' => 400]);
                }
            } else {
                echo json_encode(["success" => false, "status" => "Invalid Email Address!", "email" => $email, 'response' => 400]);
            }
        } else {
            echo json_encode(["success" => false, "status" => "Make sure that your last name clear from special character!", 'response' => 400]);
        }
    } else {
        echo json_encode(["success" => false, "status" => "Make sure that your first name clear from special character!", 'response' => 400]);
    }
} else {
    echo json_encode(["success" => false, "status" => "Please fill all the required fields!", 'response' => 400]);
}
