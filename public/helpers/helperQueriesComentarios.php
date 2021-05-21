<?php

require_once __DIR__ . "\..\helpers\\helperEncryptDecrypt.php";
require_once __DIR__ . "\..\handlers\\dbHandlerUsers.php";
class HelperQueriesComentarios
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

    public function createComment($nombre, $email, $motivo,$message )
    {
      
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            //check if the length is valid
            // insert query
            $stmt =  $GLOBALS['connect']->prepare("INSERT INTO comentarios(nombre, email, motivo,mensaje) values(?, ?, ?, ?)");
            $stmt->bind_param("ssis", $nombre, $email, $motivo, $message);
            $result = $stmt->execute();
            $stmt->close();
            // Check for successful insertion
            if ($result)
            {
                $response["success"] = "Comentario exitoso";
            } 
            else 
            {
                $response["message"] = "Oops! Ocurrio un error al registrar";
                
            }                            
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexion a la base de datos";
        }
       
        
        // First check if user already existed in db
       
        return $response;
    }
    public function showComments($token)
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
                $stmt = $GLOBALS['connect']->prepare("SELECT * from comentarios");
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
                    $response["message"] = "Oops! Ocurrio un error al eliminar el comentario";
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
            $response["message"] = "Oops! No hay conexion a la base de datos";
        }
        return $response;
    }
    public function deleteComment($id,$token)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
        {
            $json =  explode(":",$this->hed->decrypt($token)); 
        
            
            if($this->dbhu->isUserExists(substr($json[1],1,-1)))
            {

                if($this->isCommentExists($id))
                {
                    // insert query
                    $stmt =  $GLOBALS['connect']->prepare("DELETE FROM comentarios where id='$id'");
                    $result = $stmt->execute();
                    $stmt->close();
                    // Check for successful insertion
                    if ($result)
                    {
                        $response["success"] = "Comentario eliminado";
                    } 
                    else 
                    {
                        $response["message"] = "Oops! Ocurrio un error al eliminar el comentario";
                    }  
                }
                else
                {
                    $response["message"] = "El comentario con  Id=".$id." es inexistente";
                }
            }
            else{
               $response["no_authorized"] = "No autorizado";
            }
            
            $response["error"] = false;
                                        
        }
        else
        {
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexion a la base de datos";
        }
        return $response;
    }

    private function isCommentExists($id)
    {
        $stmt = $GLOBALS['connect']->prepare("SELECT id from usuarios WHERE id = '$id'");
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
}