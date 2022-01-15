<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

$servidor = "localhost";
$usuario = "root";
$password = "root";
$bd = "usertest";

$db_conn = mysqli_connect($servidor, $usuario, $password, $bd);

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->country)
    && isset($data->city)

    && !empty(trim($data->country))
    && !empty(trim($data->city))
) {
    $country = mysqli_real_escape_string($db_conn, trim($data->country));
    $city = mysqli_real_escape_string($db_conn, trim($data->city));
    /*     $id = mysqli_real_escape_string($db_conn, trim($data->id));
 */
    if (filter_var($city, FILTER_SANITIZE_SPECIAL_CHARS)) {

        $rowId = $_SESSION["ID"];
        $sql = mysqli_query($db_conn, "UPDATE `users`(`country`,`city`) VALUES('$country','$city') WHERE(id = $rowId)");
        if ($sql) {
            echo json_encode([
                "success" => true,
                "status" => "User Inserted.",
                "id" => $_SESSION["ID"]
            ]);
        } else {
            $rowId = $_SESSION["ID"];
            echo json_encode([
                "success" => false,
                "status" => "Please make sure that all your information correct!",
                "id" => $_SESSION["ID"],
                "name" => $_SESSION["NAME"],
                "country" => $country,
                "city" => $city,
                "conn" => $db_conn->error,
                "sql" => $sql
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "status" => "Invalid City name!",
            "id" => $_SESSION["ID"],
            "name" => $_SESSION["NAME"],
            "country" => $country,
            "city" => $city,
            "conn" => $db_conn->error,
            "sql" => $sql
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "status" => "Please fill all the required fields!",
        "id" => $_SESSION["ID"],
        "name" => $_SESSION["NAME"],
        "country" => $country,
        "city" => $city,
        "conn" => $db_conn->error,
        "sql" => $sql
    ]);
}
