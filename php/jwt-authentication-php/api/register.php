<?php
include_once './config/database.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));


$firstName = '';
$lastName = '';
$email = '';
$password = '';


if (
    isset($data->fname) && isset($data->lname) && isset($data->email) &&
    isset($data->pass) && isset($data->repass) &&
    !empty(trim($data->fname)) && !empty(trim($data->lname)) &&
    !empty(trim($data->email)) && !empty(trim($data->pass)) &&
    !empty(trim($data->repass))
) {

    $firstName = trim($data->fname);
    $lasttName =  trim($data->lname);
    $email =  trim($data->email);
    $password =  trim($data->pass);
    $validepass =  trim($data->repass);

    if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $firstName)) {
        $fname = bin2hex($firstName);
        if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $lasttName)) {
            $lname = bin2hex($lasttName);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

                $sql = "SELECT `email` FROM `users` WHERE `email` ='" . bin2hex($email) . "'";
                $result = $conn->query($sql);

                if ($result->num_rows <= 0) {
                    $emailEncry = bin2hex($email);

                    if ($password === $validepass) {
                        $uppercase = preg_match('@[A-Z]@', $password);
                        $lowercase = preg_match('@[a-z]@', $password);
                        $number    = preg_match('@[0-9]@', $password);
                        $specialChars = preg_match('@[^\w]@', $password);

                        if ($uppercase && $lowercase && $number && $specialChars && strlen($password) > 8) {

                            $password_hash = password_hash($password, PASSWORD_BCRYPT);
                            $query = "INSERT INTO users (name, prename, email, password) VALUES ('$fname', '$lname', '$emailEncry', '$password_hash')";
                            if ($conn->query($query) === TRUE) {

                                echo json_encode(["success" => true, "status" => "User Inserted", 'response' => 200]);
                            } else {
                                echo json_encode(["success" => false, "status" => "Unable to register the user!", 'response' => 400]);
                            }
                        } else {
                            echo json_encode(["success" => false, "status" => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.", 'response' => 400]);
                        }
                    } else {
                        echo json_encode(["success" => false, "status" => "Verifies that the given password matches the Confirm Password!", 'response' => 400]);
                    }
                } else {

                    echo json_encode(["success" => false, "status" => "Email Address already exist, try something else.!", 'response' => 400]);
                }
            } else {
                echo json_encode(["success" => false, "status" => "Invalid Email Address!", 'response' => 400]);
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
