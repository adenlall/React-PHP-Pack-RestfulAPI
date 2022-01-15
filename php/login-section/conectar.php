<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];

function conectarDB(){

  $servidor = "localhost";
  $usuario = "root";
  $password = "root";
    $bd = "usertest";



    $db_conn = mysqli_connect($servidor, $usuario, $password, $bd);

    if ($db_conn) {
            echo "";
        }else{
        echo json_encode(["success" => false, "status" => "failed to connect with data-base!"]);
    }

    return $db_conn;
}
?>
