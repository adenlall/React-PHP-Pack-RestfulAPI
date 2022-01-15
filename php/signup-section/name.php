<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$servidor = "localhost";
$usuario = "root";
$password = "root";
$bd = "usertest";

$db_conn = mysqli_connect($servidor, $usuario, $password, $bd);

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->email) && isset($data->password) && isset($data->birthday) && isset($data->name) &&
    !empty(trim($data->email)) && !empty(trim($data->password)) && !empty(trim($data->birthday)) && !empty(trim($data->name))
) {
    $name = mysqli_real_escape_string($db_conn, trim($data->name));
    $email = mysqli_real_escape_string($db_conn, trim($data->email));
    $password = mysqli_real_escape_string($db_conn, trim($data->password));
    $birthday = mysqli_real_escape_string($db_conn, trim($data->birthday));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO users (name, email, password, birthday) VALUES ('$name', '$email', '$password', '$birthday')";
        if ($db_conn->query($sql) === TRUE) {
            $last_id = mysqli_insert_id($db_conn);

            $_SESSION["ID"] = $last_id;
            $_SESSION["NAME"] = $name;

            echo json_encode(["success" => true, "status" => "User Inserted.", "id" => $_SESSION["ID"], "name" => $_SESSION["NAME"]]);
        } else {
            echo json_encode(["success" => false, "query" => $db_conn->query($sql), "conn" => $db_conn->error, "sql" => $sql, "email" => $email, "password" => $password, "birthday" => $birthday]);
        }
    } else {
        echo json_encode(["success" => false, "status" => "Invalid Email Address!", "email" => $email, "birthday" => $birthday]);
    }
} else {
    $last_id = mysqli_insert_id($db_conn);

    $_SESSION["ID"] = $last_id;
    $_SESSION["NAME"] = $name;

    echo json_encode(["success" => false, "status" => "Please fill all the required fields!", "id" => $_SESSION["ID"], "name" => $_SESSION["NAME"]]);
}
