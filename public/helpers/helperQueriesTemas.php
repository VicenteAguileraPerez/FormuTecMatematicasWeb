<?php
include_once(__DIR__ . "\..\conexion.php");
require_once __DIR__ . "\..\helpers\\helperEncryptDecrypt.php";
require_once __DIR__ . "\..\helpers\\helperSaveFiles.php";
require_once __DIR__ . "\..\handlers\\dbHandlerUsers.php";

class HelperQueriesTemas
{
    private $hed;
    private  $dbhu;
    
    function __construct()
    {
        // opening db connection
        new ConnectionBBDD();
        $this->hed = new HelperEncryptDecrypt();
        $this->dbhu = new DBHandlerUsers();
        
        
    }

    public function createTema($nombre, $imagen,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
          
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                //check if the length is valid
                // insert query
                $stmt =  $GLOBALS['connect']->prepare("INSERT INTO temas(nombre, imagen) values(?, ?)");
                $stmt->bind_param("ss", $nombre, $imagen);
                $result = $stmt->execute();
                $stmt->close();
                // Check for successful insertion
                if ($result)
                {
                    $response["success"] = " Tema creado de manera exitosa";
                } 
                else 
                {
                    $response["message"] = "Oops! Ocurrio un error al crear tema";
                    
                } 
            }
            else
            {
                $response["no_authorized"] = "No autorizado ".$token;
            }
                                       
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
       
        
        // First check if user already existed in db
       
        return $response;
    }
    public function showTemas($token)
    {
        $response = array();
        $allRows = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
           
            $json =  explode(":",$this->hed->decrypt($token));
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            {
                // insert query
                $stmt = $GLOBALS['connect']->prepare("SELECT * from temas");
                $result= $stmt->execute();
                $rows= $stmt->get_result();
                
                /**
                 * "current_field": null,
                 * "field_count": null,
                 * "lengths": null,
                 * "num_rows": null,
                 * "type": null
                 */
                $num_rows = $rows->num_rows;
                // Check for successful selection
                if ($result)
                {
                        while ($data = $rows->fetch_assoc())
                        {
                
                            $allRows[] = $data;
            
                        }
                        $response["count"] =  $num_rows;
                        $response["success"] = $allRows;

                } 
                else 
                {
                    $response["message"] = "Oops! Ocurrio un error al leer los temas";
                }       
                    $response["error"] = false;
                    $stmt->close();
            }
            else
            {
                $response["no_authorized"] = "No autorizado";
            }
                                      
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }
    //tema eliminado se cambia el campo de id_tema de la tabla subtemas
    public function deleteTema($id,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
         
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isTemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("DELETE FROM temas where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Tema eliminado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al eliminar el Tema";
                    }  
                }
                else
                {
                    $response["message"] = "El Tema con  Id=".$id." es inexistente";
                }
                $response["error"] = false;
            }
            else
            {
                $response["no_authorized"] = "No autorizado";
            }                            
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }

    public function putTema($id,$nombre,$imagen,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isTemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("UPDATE temas set nombre='$nombre',imagen='$imagen'  where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Tema actualizado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al editar el tema";
                    }  
                }
                else
                {
                    $response["message"] = "El tema con  Id=".$id." es inexistente";
                }
                $response["error"] = false;
            }
            else
            {
                $response["no_authorized"] = "No autorizado";
            }
                                        
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }
    public function patchTema($id,$nombre,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isTemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("UPDATE temas set nombre='$nombre'  where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Tema actualizado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al editar el tema";
                    }  
                }
                else
                {
                    $response["message"] = "El tema con  Id=".$id." es inexistente";
                }
                $response["error"] = false;
            }
            else
            {
                $response["no_authorized"] = "No autorizado";
            }
                                        
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }

    private function isTemaExists($id)
    {
        $stmt = $GLOBALS['connect']->prepare("SELECT id from temas WHERE id = '$id'");
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
}