<?php

    class Users{

        private $con;

        public $id;
        public $username;
        public $email;
        public $password;

        public function __construct($db){
            $this->con=$db;
        }

        public function Login($email){

            $sql="SELECT * FROM usuarios WHERE usuario='$email'";

            $stmt=$this->con->prepare($sql);

            $stmt->execute();
            
            return $stmt;

        }

        public function GetById($id){


            $sql="SELECT * FROM usuarios WHERE id=$id";

            $stmt=$this->con->prepare($sql);

            $stmt->execute();
            
            return $stmt;

        }

        public function Register(){

            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));

            $sql="INSERT INTO usuarios(nombre,usuario,clave) 
            values('$this->username','$this->email','".password_hash($this->password,PASSWORD_DEFAULT)."')";
            
            $stmt=$this->con->prepare($sql);

            if($stmt->execute()){
                return true;
            }

            printf("Error %s .\n",$stmt->error);

            return false;
            
        }

    }

?>