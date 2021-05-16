<?php

require_once __DIR__ . "\..\helpers\\helperValidations.php";
include_once(__DIR__ . "\..\conexion.php");

class DBHandlerUsers
{
    
    private $validations;

    function __construct()
    {
        // opening db connection
        new ConnectionBBDD();
        $this->validations = new Validations();
    }

    // creating new user if not existed
    public function createUser($nombre, $email, $pass)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            //check if the length is valid
            $arrayString= array('nombre'=>$nombre,'email'=>$email,'password'=>$pass);
            $arrayLengths= array('nombre'=>45,'email'=>45,'password'=>45);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    if ($this->validations->isValidPassword($pass)) 
                    {
                        if (!$this->isUserExists($email)) {
                            // insert query
                            $stmt =  $GLOBALS['connect']->prepare("INSERT INTO usuarios(nombre, email, password) values(?, ?, ?)");
                            $stmt->bind_param("sss", $nombre, $email, $pass);
                            $result = $stmt->execute();
                            $stmt->close();
                            // Check for successful insertion
                            if ($result) {
                                // User successfully inserted
                                $response["error"] = false;
                                if ($this->getUserByEmail($email) !== NULL) {
                                    $response["success"] = $this->getUserByEmail($email);
                                } else {
                                    $response["message"] = "Oops! Ocurrio un error al registrar";
                                }
                            } else {
                                // Failed to create user
                                $response["error"] = true;
                                $response["message"] = "Oops! Ocurrio un error al registrar";
                            }
                        }
                        else
                        {
                            // User with same email already existed in the db
                            $response["error"] = false;
                            $response["message"] = "Ya existe un usuario con ese email";
                        }
                    } else {
                        $response["error"] = false;
                        $response["message"] = "Contraseña debe tener mínimo 8 caracteres";
                    }
                } 
            }
        }
        else{
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexion a la base de datos";
        }
       
        
        // First check if user already existed in db
       
        return $response;
    }

    /**
     * Fetching user by email
     * @param String $email User email id
     */
    public function getUserByEmail($email)
    {
        $user = array();
        $stmt = $GLOBALS['connect']->prepare("SELECT id, nombre, email FROM usuarios WHERE email = '$email'");
        if ($stmt->execute()) {
            // $user = $stmt->get_result()->fetch_assoc();
            $result = $stmt->get_result()->fetch_assoc();
            $response["error"] = false;
            if ($result) {
                $user = array();
                $user["id"] = $result['id'];
                $user["nombre"] = $result['nombre'];
                $user["email"] = $result['email'];
                return $user;
            } else {
                return NULL;
            }
            $stmt->close();
        } else {
            return NULL;
        }
    }

    /**
     * Checking for duplicate user by email address
     * @param String $email email to check in db
     * @return boolean
     */
    private function isUserExists($email)
    {
        $stmt = $GLOBALS['connect']->prepare("SELECT id from usuarios WHERE email = '$email'");
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    public function modifyUser($nombre, $email, $pass, $id)
    {
        $response = array();
        // First check if user already existed in db
        if ($GLOBALS['connect'] !== NULL) 
        {
            $arrayString= array('nombre'=>$nombre,'email'=>$email,'password'=>$pass);
            $arrayLengths= array('nombre'=>45,'email'=>45,'password'=>45);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    if ($this->validations->isValidPassword($pass)) {
                        // insert query
                        $stmt = $GLOBALS['connect']->prepare("update usuarios set nombre='" . $nombre . "',email='" . $email . "',actividades='" . $pass . "' where id='" . $id . "'");
                        $result = $stmt->execute();
                        $stmt->close();
                        // Check for successful insertion
                        if ($result) {
                            // User successfully inserted
                            $response["error"] = false;
                            $response["success"] = $this->getUserByEmail($email);
                        } else {
                            // Failed to create user
                            $response["error"] = true;
                            $response["message"] = "Oops! Ocurrio un error al modificar";
                        }
                    } else {
                        $response["error"] = false;
                        $response["message"] = "Contraseña debe tener mínimo 8 caracteres";
                    }           
                }
            }
        } 
        else 
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
    }

    public function iniciarSesion($email, $pass)
    {
        $response = array();
        if ($GLOBALS['connect'] !== NULL) 
        {
            $arrayString= array('email'=>$email,'password'=>$pass);
            $arrayLengths= array('email'=>45,'password'=>45);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    $stmt = $GLOBALS['connect']->prepare("SELECT id, nombre, email from usuarios WHERE email = '$email' and password='$pass'");
                    if ($stmt->execute()) {
                        // $user = $stmt->get_result()->fetch_assoc();
                        $result = $stmt->get_result()->fetch_assoc();
                        $response["error"] = false;
                        if ($result) {
                            $user = array();
                            $user["id"] = $result['id'];
                            $user["nombre"] = $result['nombre'];
                            $user["email"] = $result['email'];
                            $response["success"] = $user;
                        } else if ($this->getUserByEmail($email) !== NULL) {
                            $response["message"] = "Contraseña incorrecta";
                        } else {
                            $response["message"] = "No existe un cliente con esas credenciales";
                        }
                        $stmt->close();
                    } else {
                        $response["message"] = "Error al iniciar sesión";
                        $response["error"] = false;
                    }   
                }
            } 
        } 
        else 
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }
}
