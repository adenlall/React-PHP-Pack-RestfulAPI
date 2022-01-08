<?php
/* son_encode(array('conectado'=>false, 'error' => 'Wrong password, try again.'));
 */
    header('Access-Control-Allow-Origin: *'); 
    header('Content-Type:application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST'); 
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include "./code/database.php";
    include "./code/coder.php";
    include "./code/config.php";

  

    $code=new Coder();

    $data=json_decode(file_get_contents("php://input"));


    if($_SERVER["REQUEST_METHOD"]!="POST"):
        echo json_encode(array('conectado'=>false, "error" => "Page Not Found !"));
        elseif(
            !isset($data->usuario) 
            || !isset($data->clave)
            || empty(trim($data->usuario))
            || empty($data->clave)
        ):
        echo json_encode(array('conectado'=>false, 'error' => 'Please compleate all feild, and try again.'));
        else:
            $email=trim($data->usuario);
            $password=trim($data->clave);

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)):
                echo json_encode(array('conectado'=>false, 'error' => 'Wrong email.'));
            elseif(strlen($password) < 8):
                echo json_encode(array('conectado'=>false, 'error' => "The Password Must Be At Least 8 Characters !"));
        
            else:
                try{
                    $stmt=$user->Login($email);

                    if($stmt->rowCount()):
                        $row=$stmt->fetch(PDO::FETCH_ASSOC);
/*                         $checkPass=password_verify($password,$row['Password']); */        
                        if($password===$row['Password']):

                            $val=$code->coding($row['ID'],'encrypt');

                            echo json_encode(array(
                                
                                    "conectado" => true,
                                    "error" => "You Have Logined Successfully .",
                                    "user"=>$val
                            ));
                            
                        else:
                            echo json_encode(array('conectado'=>false, 'error' => 'Wrong password, try again.'));
                        endif;

                        
                    else:
                        echo json_encode(array('conectado'=>false, 'error' => "Invalid Email Or Password !"));
                    endif;

                }catch(PDOException $e){
                    echo json_encode(array('conectado' => false,"error" => $e->getMessage()));
                }   
        endif;
    endif;


?>