<?php
require_once __DIR__ . "\..\helpers\\helperValidations.php";
require_once __DIR__ . "\..\helpers\\helperQueriesSubtemas.php";
require_once __DIR__ . "\..\helpers\\helperSaveFiles.php";

class dbHandlerSubtemas
{
    private $validations;
    private $helperQueriesSubtemas;
    private $helperSaveFiles;
    function __construct()
    {
        $this->helperSaveFiles = new HelperSaveFiles();
        $this->validations = new Validations();
        $this->helperQueriesSubtemas = new HelperQueriesSubtemas();
    }
    function createSubtema($nombre,$pdf,$idTema,$token)
    {
        $response = array();
        
        $response = $this->helperSaveFiles->savePDF($pdf,$nombre);

        if(count($response)==1)
        {
                $arrayString= array('nombre'=>$nombre);
                $arrayLengths= array('nombre'=> 100);
                $pdf = $response['pdf'];
                $response=$this->validations->validateLenght($arrayString,$arrayLengths);
                if(count($response)==0)
                {
                    $arrayString= array('nombre'=>$nombre,'pdf'=>$pdf);
                    $response=$this->validations->validateNotEmpty($arrayString);
                    if(count($response)==0)
                    {
                        $response =$this->helperQueriesSubtemas->createSubtema($nombre,$pdf,$idTema,$token);
                    }
                }
        }
           
       
        return $response;

    }
    function deleteSubtema($id,$url,$token)
    {
        $response = array();
        $this->helperSaveFiles->deletePDF($url);
        $response = $this->helperQueriesSubtemas->deleteSubtema($id,$token); 
                               
        
        return $response;

    }
    function putSubtema($id,$nombre,$nombreAnt,$pdf,$idTema,$token)
    {
        $response = array();
        $this->helperSaveFiles->deletePDF(__DIR__."/pdf/$nombre.pdf");
        $this->helperSaveFiles->deletePDF(__DIR__."/pdf/$nombreAnt.pdf");
        $response = $this->helperSaveFiles->savePDF($pdf,$nombre);

        if(count($response)==1)
        {
            
            $arrayString= array('nombre'=>$nombre);
            $arrayLengths= array('nombre'=> 100);
            $pdf = $response['pdf'];
            $response=$this->validations->validateLenght($arrayString,$arrayLengths);
            if(count($response)==0)
            {
                $arrayString= array('nombre'=>$nombre,'pdf'=>$pdf);
                $response=$this->validations->validateNotEmpty($arrayString);
                if(count($response)==0)
                {
                    $response = $this->helperQueriesSubtemas->putSubtema($id,$nombre,$pdf,$idTema,$token); 
                }
            }
        }                  
        
        return $response;

    }
    function patchSubtema($id,$nombre,$idTema,$token)
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
                    $response = $this->helperQueriesSubtemas->patchSubtema($id,$nombre,$idTema,$token); 
                }
            }
                               
        
        return $response;

    }
    function showSubtemas($token)
    {
        $response = array();
        
        $response = $this->helperQueriesSubtemas->showSubtemas($token); 
                               
        return $response;

    }
    function showSubtemasFront($idTema)
    {
        $response = array();
        
        $response = $this->helperQueriesSubtemas->showSubtemasFront($idTema); 
                               
        return $response;

    }
}