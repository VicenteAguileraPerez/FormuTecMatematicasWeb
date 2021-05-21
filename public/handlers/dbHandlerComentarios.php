<?php
require_once __DIR__ . "\..\helpers\\helperValidations.php";
require_once __DIR__ . "\..\helpers\\helperQueriesComentarios.php";
include_once(__DIR__ . "\..\conexion.php");

class dbHandlerComentarios
{
    private $validations;
    private $helperQueriesComentarios;

    function __construct()
    {
     
        $this->validations = new Validations();
        $this->helperQueriesComentarios = new HelperQueriesComentarios();
    }
    function createComment($nombre,$email,$motivo,$message)
    {
        $response = array();
        
            $arrayString= array('nombre'=>$nombre,'email'=>$email,'motivo'=>$motivo,'message'=>$message);
            $arrayLengths= array('nombre'=>45,'email'=>45,'motivo'=>1,'message'=>200);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    $response = $this->helperQueriesComentarios->createComment($nombre, $email, $motivo,$message );
                }
            }
       
        return $response;

    }
    function deleteComment($id,$token)
    {
        $response = array();
      
        $response = $this->helperQueriesComentarios->deleteComment($id,$token); 
                               
        
        return $response;

    }
    function showComments($token)
    {
        $response = array();
        
        $response = $this->helperQueriesComentarios->showComments($token); 
                               
        return $response;

    }
}