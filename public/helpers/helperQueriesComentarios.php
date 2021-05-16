<?php

class HelperQueriesComentarios
{
    function __construct()
    {
        // opening db connection
        new ConnectionBBDD();
        
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
    public function showComments()
    {
        $response = array();
        $allRows = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
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
            $response["error"] = true;
            $response["message"] = "Oops! No hay conexion a la base de datos";
        }
        return $response;
    }
    public function deleteComment($id)
    {
        $response = array();
        //check if the connection is valid
        if ($GLOBALS['connect'] !== NULL) 
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