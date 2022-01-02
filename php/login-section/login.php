<?php
header('Access-Control-Allow-Origin: "http://localhost:3000/"');//you can changed to '*'.
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
    include "conectar.php";
    $mysqli = conectarDB();
    //sleep(1);	
	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);    
    session_start();    
    $mysqli->set_charset('utf8');
	    
	$usuario = $dataObject-> usuario;
	$pas =	$dataObject-> clave;
    
  if ($nueva_consulta = $mysqli->prepare("SELECT 
  usuarios.nombre, usuarios.clave, usuarios.apellidos, usuarios.usuario, usuarios.idTipoUsuario, usuarios.id, tipo_usuario.etiquetaTipoUsuario, tipo_usuario.descripcionTipoUsuario 
  FROM usuarios 
  INNER JOIN tipo_usuario ON usuarios.idTipoUsuario = tipo_usuario.idTipoUsuario
  WHERE usuario = ?")) {
        $nueva_consulta->bind_param('s', $usuario);
        $nueva_consulta->execute();
        $resultado = $nueva_consulta->get_result();
        if ($resultado->num_rows == 1) {
            $datos = $resultado->fetch_assoc();
             $PasswordSQL = $datos['clave'];

            if (  password_verify($pas,$PasswordSQL) ){

                $_SESSION['usuario'] = $datos['usuario'];
                echo json_encode(array('conectado'=>true,'usuario'=>$datos['usuario'], 'nombre'=>$datos['nombre'],  'apellidos'=>$datos['apellidos'], 'id'=>$datos['id'], 'idTipoUsuario'=>$datos['idTipoUsuario'], 'etiquetaTipoUsuario'=>$datos['etiquetaTipoUsuario']  ) );

              }else {
                 echo json_encode(array('conectado'=>false, 'error' => 'Wrong password, try again.'));
                    }
        }
        else {
              echo json_encode(array('conectado'=>false, 'error' => "User name doesn't existe."));
        }
        $nueva_consulta->close();
      }
      else{
        echo json_encode(array('conectado'=>false, 'error' => 'FATAL ERROR => connectin with data base'));
      }
 // }
$mysqli->close();
?>
