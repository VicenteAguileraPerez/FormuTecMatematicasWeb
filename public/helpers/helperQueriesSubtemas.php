<?php

include_once(__DIR__ . "\..\conexion.php");
require_once __DIR__ . "\..\helpers\\helperEncryptDecrypt.php";
require_once __DIR__ . "\..\helpers\\helperSaveFiles.php";
require_once __DIR__ . "\..\handlers\\dbHandlerUsers.php";

class HelperQueriesSubtemas
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

    public function createSubtema($nombre, $pdf, $idTema, $token)
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
                $stmt =  $GLOBALS['connect']->prepare("INSERT INTO subtemas(nombre, pdf, idTema) values(?, ?, ?)");
                $stmt->bind_param("ssi", $nombre, $pdf, $idTema);
                $result = $stmt->execute();
                $stmt->close();
                // Check for successful insertion
                if ($result)
                {
                    $response["success"] = " Subtema creado de manera exitosa";
                } 
                else 
                {
                    $response["message"] = "Oops! Ocurrio un error al crear subtema";
                    
                } 
            }
            else
            {
                $response["no_authorized"] = "No autorizado ";
            }
            $response["error"] = false;
                                       
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }

    public function showSubtemas($token)
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
                $stmt = $GLOBALS['connect']->prepare("SELECT * from subtemas");
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
                    $response["message"] = "Oops! Ocurrio un error al leer los subtemas";
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
   
    public function showSubtemasFront($idTema)
    {
        $response = array();
        $allRows = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
           
            
                // insert query
                $stmt = $GLOBALS['connect']->prepare("SELECT * from subtemas where idTema=".$idTema);
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
                    $response["message"] = "Oops! Ocurrio un error al leer los subtemas";
                }       
                    $response["error"] = false;
                    $stmt->close();
            
                                      
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexión a la base de datos";
        }
        return $response;
    }
    //tema eliminado se cambia el campo de id_tema de la tabla subtemas
    public function deleteSubtema($id,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
         
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isSubtemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("DELETE FROM subtemas where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Subtema eliminado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al eliminar el subtema";
                    }  
                }
                else
                {
                    $response["message"] = "El Subtema con  Id=".$id." es inexistente";
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

    public function putSubtema($id,$nombre,$pdf,$idTema,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isSubtemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("UPDATE subtemas set nombre='$nombre',pdf='$pdf', idTema='$idTema'  where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Subtema actualizado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al editar el subtema";
                    }  
                }
                else
                {
                    $response["message"] = "El subtema con  Id=".$id." es inexistente";
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

    public function patchSubtema($id,$nombre,$idTema,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token));
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            { 
                if($this->isSubtemaExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("UPDATE subtemas set nombre='$nombre', idTema='$idTema'  where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Subtema actualizado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al editar el subtema";
                    }  
                }
                else
                {
                    $response["message"] = "El subtema con  Id=".$id." es inexistente";
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

    private function isSubtemaExists($id)
    {
        $stmt = $GLOBALS['connect']->prepare("SELECT id from subtemas WHERE id = '$id'");
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
}