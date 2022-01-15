<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../login-section/conectar.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->user_clubs)
    /*     && isset($data->user_id)
 */    && !empty(trim($data->user_clubs))
    /*     && !empty(trim($data->user_id))
 */
) {
    $clubs = mysqli_real_escape_string($db_conn, trim($data->user_clubs));
    /*     $id = mysqli_real_escape_string($db_conn, trim($data->user_id));
 */
    if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {


        $insertUser = mysqli_query($db_conn, "UPDATE `users`(`clubs`) VALUES('$clubs') WHERE(id = $id)");
        if ($insertUser) {
            $id = mysqli_insert_id($db_conn);
            echo json_encode(["success" => true, "status" => "User Inserted.", "id" => $id]);
        } else {
            echo json_encode(["success" => false, "status" => "Please make sure that all your information correct!"]);
        }
    } else {
        echo json_encode(["success" => false, "status" => "Invalid Email Address!"]);
    }
} else {
    echo json_encode(["success" => false, "status" => "Please fill all the required fields!"]);
}
