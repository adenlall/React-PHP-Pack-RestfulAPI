<?php
	include "conectar.php";
    $conn = conectarDB();
	
	$password= "456";
	
	
	$usuario= "jose@correo.tic";
	$nombre= "Jose";
	$apellidos= "Jiménez Blanco";
	$idTipoUsuario= "2";	
	$clave = password_hash($password, PASSWORD_DEFAULT);
	
	echo $password;
	echo "<br/>";
	echo $clave;
	echo "<hr/>";
	

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO usuarios (usuario, clave, nombre, apellidos, idTipoUsuario)

VALUES ('$usuario', '$clave', '$nombre', '$apellidos', '$idTipoUsuario' )";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
	
//fuente https://www.w3schools.com/php/php_mysql_insert.asp
?>