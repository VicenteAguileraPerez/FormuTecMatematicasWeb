<?php

require_once __DIR__ . "\..\helpers\\validations.php";
include_once(__DIR__ . "\..\conexion.php");

class DBHandlerUsers
{
    private $conn;
    private $validations;

    function __construct()
    {
        // opening db connection
        new ConnectionBBDD();
        $this->validations = new Validations();
        $this->conn =  $GLOBALS['connect'];
    }

    // creating new user if not existed
    public function createUser($nombre, $email, $pass)
    {
        $response = array();
        // First check if user already existed in db
        if ($this->validations->isNotEmpty($nombre) and $this->validations->isNotEmpty($email)) {
            if ($this->validations->isValidPassword($pass)) {
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
                            $response["user"] = $this->getUserByEmail($email);
                        } else {
                            $response["message"] = "Oops! Ocurrio un error al registrar";
                        }
                    } else {
                        // Failed to create user
                        $response["error"] = true;
                        $response["message"] = "Oops! Ocurrio un error al registrar";
                    }
                } else {
                    // User with same email already existed in the db
                    $response["error"] = false;
                    $response["message"] = "Ya existe un usuario con ese email";
                }
            } else {
                $response["error"] = false;
                $response["message"] = "Contraseña debe tener mínimo 8 caracteres";
            }
        } else {
            $response["error"] = false;
            $response["message"] = "Campo nombre o campo email están vacíos";
        }
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
        // First check if user already existed in db
        if ($GLOBALS['connect'] !== NULL) {
            if ($this->validations->isNotEmpty($nombre) and $this->validations->isNotEmpty($email)) {
                if ($this->validations->isValidPassword($pass)) {
                    // insert query
                    $stmt = $GLOBALS['connect']->prepare("update usuarios set nombre='" . $nombre . "',email='" . $email . "',actividades='" . $pass . "' where id='" . $id . "'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result) {
                        // User successfully inserted
                        $response["error"] = false;
                        $response["user"] = $this->getUserByEmail($email);
                    } else {
                        // Failed to create user
                        $response["error"] = true;
                        $response["message"] = "Oops! Ocurrio un error al modificar";
                    }
                } else {
                    $response["error"] = false;
                    $response["message"] = "Contraseña debe tener mínimo 8 caracteres";
                }
            } else {
                $response["error"] = false;
                $response["message"] = "Campo nombre o campo email están vacíos";
            }
        } else {
            $response["error"] = true;
            $response["message"] = "Oops! Ocurrio un error";
        }
    }

    public function iniciarSesion($email, $pass)
    {
        $response = array();
        if ($this->validations->isNotEmpty($email) and $this->validations->isNotEmpty($pass)) {
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
                    $response["user"] = $user;
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
        } else {
            $response["error"] = false;
            $response["message"] = "Campo email o campo password están vacíos";
        }
        return $response;
    }
}
