<?php
require_once __DIR__ . "\..\helpers\\helperValidations.php";
require_once __DIR__ . "\..\helpers\\helperQueriesTemas.php";
require_once __DIR__ . "\..\helpers\\helperSaveFiles.php";

class dbHandlerTemas
{
    private $validations;
    private $helperQueriesTemas;
    private $helperSaveFiles;
    function __construct()
    {
        $this->helperSaveFiles = new HelperSaveFiles();
        $this->validations = new Validations();
        $this->helperQueriesTemas = new HelperQueriesTemas();
    }
    function createTema($nombre,$descripcion,$imagen,$token)
    {
        $response = array();
        
        $response = $this->helperSaveFiles->saveImage($imagen,$nombre);

        if(count($response)==1)
        {
                $arrayString= array('nombre'=>$nombre);
                $arrayLengths= array('nombre'=> 100);
                $imagen = $response['image'];
                $response=$this->validations->validateLenght($arrayString,$arrayLengths);
                if(count($response)==0)
                {
                    $arrayString= array('nombre'=>$nombre,"imagen"=>$imagen,"descripción"=>$descripcion);
                    $response=$this->validations->validateNotEmpty($arrayString);
                    if(count($response)==0)
                    {
                        $response = $this->helperQueriesTemas->createTema($nombre,$descripcion,$imagen,$token);
                    }
                }
        }
           
       
        return $response;

    }
    function deleteTema($id,$url,$token)
    {
        $response = array();
        $this->helperSaveFiles->deleteImage($url);
        $response = $this->helperQueriesTemas->deleteTema($id,$token); 
                               
        
        return $response;

    }
    function putTema($id,$nombre,$nombreAnt,$descripcion,$imagen,$token)
    {
        $response = array();
        $this->helperSaveFiles->deleteImage(__DIR__."/formulas/$nombre.png");
        $this->helperSaveFiles->deleteImage(__DIR__."/formulas/$nombreAnt.png");
        $response = $this->helperSaveFiles->saveImage($imagen,$nombre);

        if(count($response)==1)
        {
            
            $arrayString= array('nombre'=>$nombre);
            $arrayLengths= array('nombre'=> 100);
            $imagen = $response['image'];
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $arrayString= array('nombre'=>$nombre,"descripción"=>$descripcion);
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    $response = $this->helperQueriesTemas->putTema($id,$nombre,$descripcion,$imagen,$token); 
                }
            }
        }                  
        
        return $response;

    }
    function patchTema($id,$nombre,$descripcion,$token)
    {
            $response = array();
            $arrayString= array('nombre'=>$nombre);
            $arrayLengths= array('nombre'=> 100);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $arrayString= array('nombre'=>$nombre,'descripción'=>$descripcion);
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    $response = $this->helperQueriesTemas->patchTema($id,$nombre,$descripcion,$token); 
                }
            }
                               
        
        return $response;

    }
    function showTemas($token)
    {
        $response = array();
        
        $response = $this->helperQueriesTemas->showTemas($token); 
                               
        return $response;

    }
    function showTemasFront()
    {
        $response = array();
        
        $response = $this->helperQueriesTemas->showTemasFront(); 
                               
        return $response;

    }
}