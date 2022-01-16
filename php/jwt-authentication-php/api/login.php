<?php
class DatabaseService
{

    private $db_host = "localhost";
    private $db_name = "usertest";
    private $db_user = "root";
    private $db_password = "root";
    private $connection;

    public function getConnection()
    {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
        } catch (PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type");


$email = '';
$password = '';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();



$data = json_decode(file_get_contents("php://input"));

$emailbim = $data->email;
$password = $data->pass;
$email = bin2hex($emailbim);
$table_name = 'users';

$query = "SELECT id, name, prename, password FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

$stmt = $conn->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $firstname = $row['name'];
    $lastname = $row['prename'];
    $password2 = $row['password'];

    if (password_verify($password, $password2)) {
        $secret_key = "MY";
        $issuer_claim = "YES"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 0; //not before in seconds
        $expire_claim = $issuedat_claim + 6000; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email
            )
        );


        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => JWT::encode($token, $secret_key),
                "email" => $email,
                "expireAt" => $expire_claim
            )
        );
    } else {

        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
}


/* import React, { useRef } from "react";
import { NavLink } from "react-router-dom";
import axios from "axios";

const URL_LOGIN =
  "http://localhost/React-Pack/php/jwt-authentication-php/api/login.php";

const logg = async (data) => {
  try {
    let response = await axios.post(URL_LOGIN, data);
    console.log(response);
    if (
      response.status === 200 &&
      response.data.jwt &&
      response.data.expireAt
    ) {
      let jwt = response.data.jwt;
      let expire_at = response.data.expireAt;

      document.querySelector(".htx").innerHTML = response.data.message;

      localStorage.setItem("access_token", jwt);
      localStorage.setItem("expire_at", expire_at);
    }
  } catch (e) {
    console.log(e);
  }
};

function Loginin(props) {
  const refEmail = useRef(null);
  const refPass = useRef(null);

  const handelLoin = async () => {
    const data = {
      email: refEmail.current.value,
      pass: refPass.current.value,
    };
    console.log(data);
    logg(data);
  };

  return (
    <div
      className="position-absolute top-50 start-50 translate-middle"
      style={{ width: "30em" }}
    >
      <form className="form" style={{ textAlign: "initial" }}>
        <label className="sr-only" htmlFor="inlineFormInputGroupUsername2">
          Username
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">📧</div>
          </div>
          <input
            type="email"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="Username"
            ref={refEmail}
          />
        </div>{" "}
        <label className="sr-only" htmlFor="inlineFormInputGroupPassword2">
          Password
        </label>
        <div className="input-group mb-2 mr-sm-2">
          <div className="input-group-prepend">
            <div className="input-group-text">🔒</div>
          </div>
          <input
            type="password"
            className="form-control"
            id="inlineFormInputGroupUsername2"
            placeholder="Password"
            ref={refPass}
          />
        </div>
        <div className="alert alert-danger">
          <span className="htx"> Insert your data </span>
        </div>
      </form>
      <NavLink className="nav-link" to="/dashboard">
        <button
          onClick={handelLoin}
          className="btn btn-lg btn-info btn-block mb-2"
        >
          Submit
        </button>
      </NavLink>
    </div>
  );
}

export default Loginin;
 */