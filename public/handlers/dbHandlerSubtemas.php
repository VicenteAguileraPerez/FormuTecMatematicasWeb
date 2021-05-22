<?php
require_once __DIR__ . "\..\helpers\\helperValidations.php";
//require_once __DIR__ . "\..\helpers\\helperQueriesTemas.php";
require_once __DIR__ . "\..\helpers\\helperSaveFiles.php";

class dbHandlerSubtemas
{
    private $validations;
    //private $helperQueriesTemas;
    private $helperSaveFiles;
    function __construct()
    {
        $this->helperSaveFiles = new HelperSaveFiles();
        $this->validations = new Validations();
        //$this->helperQueriesTemas = new HelperQueriesTemas();
    }
    function createSubtema($nombre,$pdf,$token)
    {
        $response = array();
        
        //$response = $this->helperSaveFiles->saveImage($imagen,$nombre);

        if(count($response)==1)
        {
                $arrayString= array('nombre'=>$nombre);
                $arrayLengths= array('nombre'=> 100);
                $pdf = $response['pdf'];
                $response=$this->validations->validateLenght($arrayString,$arrayLengths);
                if(count($response)==0)
                {
                    $arrayString= array('nombre'=>$nombre,"imagen"=>$pdf);
                    $response=$this->validations->validateNotEmpty($arrayString);
                    if(count($response)==0)
                    {
                        //$response = $this->helperQueriesTemas->createTema($nombre,$imagen,$token);
                    }
                }
        }
           
       
        return $response;

    }
    function deleteSubtema($id,$url,$token)
    {
        $response = array();
        //$this->helperSaveFiles->deleteImage($url);
        //$response = $this->helperQueriesTemas->deleteTema($id,$token); 
                               
        
        return $response;

    }
    function putSubtema($id,$nombre,$nombreAnt,$pdf,$token)
    {
        $response = array();
       // $this->helperSaveFiles->deleteImage(__DIR__."/formulas/$nombre.png");
        //$this->helperSaveFiles->deleteImage(__DIR__."/formulas/$nombreAnt.png");
        //$response = $this->helperSaveFiles->saveImage($imagen,$nombre);

        if(count($response)==1)
        {
            
            $arrayString= array('nombre'=>$nombre);
            $arrayLengths= array('nombre'=> 100);
            $pdf = $response['pdf'];
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $arrayString= array('nombre'=>$nombre);
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                   // $response = $this->helperQueriesTemas->putTema($id,$nombre,$imagen,$token); 
                }
            }
        }                  
        
        return $response;

    }
    function patchSubtema($id,$nombre,$token)
    {
            $response = array();
            $arrayString= array('nombre'=>$nombre);
            $arrayLengths= array('nombre'=> 100);
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $arrayString= array('nombre'=>$nombre);
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    //$response = $this->helperQueriesTemas->patchTema($id,$nombre,$token); 
                }
            }
                               
        
        return $response;

    }
    function showSubtemas($token)
    {
        $response = array();
        
        //$response = $this->helperQueriesTemas->showTemas($token); 
                               
        return $response;

    }
}