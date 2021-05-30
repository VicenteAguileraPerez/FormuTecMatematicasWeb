<?php

use Nyholm\Psr7\Response;

class HelperSaveFiles
{
    public function __construct()
    {
        
    }
    public function deleteImage($url)
    {
        $array = explode("/",$url);

       
        //nombre y exten
        //hola.como.estas.png file[0]=hola file[1]=png
        $file=explode(".",$array[count($array)-1]);
        

        unset($file[count($file)-1]);//elimino extension
        

        $nameFile = implode("\.",$file);
        

        $url = dirname(__DIR__).'/formulas/'.$nameFile;


        if (file_exists($url.".png"))
        {
            unlink($url.".png");
        }
        else if(file_exists($url.".jpg"))
        {
            unlink($url.".jpg");
        }
        else if(file_exists($url."jpeg")){
            unlink($url.".jpeg");
        }
        
    }
    public function deletePDF($url)
    {
        $array = explode("/",$url);

       
        //nombre y exten
        //hola.como.estas.png file[0]=hola file[1]=png
        $file=explode(".",$array[count($array)-1]);
        

        unset($file[count($file)-1]);//elimino extension
        

        $nameFile = implode("\.",$file);
        

        $url = dirname(__DIR__).'/pdf/'.$nameFile;


        if (file_exists($url.".pdf"))
        {
            unlink($url.".pdf");
        }
       
        
    }


    public function saveImage($file,$nombre)
    {
        $dir = dirname(__DIR__)."\\formulas\\";//C:/xammp2/htdocs//FR....
        $response = array();
        $type = $file['file']['type'];
        $extension =  pathinfo($file['file']['name'])['extension'];
        $carpeta_destino = $dir;
        $imagen = $carpeta_destino.$nombre.".".$extension;

        
            if($type=='image/png' || $type =='image/jpg' || $type =='image/jpeg')
            {
                  
                    move_uploaded_file($file['file']['tmp_name'],$imagen);
                    $array = explode("\\", $imagen);
                    
                    for ($i=0; $i < count($array); $i++)
                    { 
                        if($array[$i]!="FormuTecMatematicasWeb")
                        { 
                            unset($array[$i]);
                        }
                        else
                        {
                            break;
                        }
                    }
                
                    $imagen="http://localhost/".implode ( '/', $array );
                    $response['image']=$imagen;
            }
            else
            {
                if($_FILES['file']['size']==0)
                { 
                    $response["big_pdf"]="Tamaño de pdf excedido ";
                    $response['error']=false;
                }
                else
                {
                    $response["pdf_format"]="Formato invalido, solo (PDF) ";
                    $response['error']=false;
                }
               
            }
        
        
        return $response;
    }
    public function savePDF($file,$nombre)
    {
        $dir = dirname(__DIR__)."\\pdf\\";//C:/xammp2/htdocs//FR....
        $response = array();
        $type = $file['file']['type'];
        $extension =  pathinfo($file['file']['name'])['extension'];
        $carpeta_destino = $dir;
        $pdf = $carpeta_destino.$nombre.".".$extension;

        
            if($type =='application/pdf')
            {
                  
                    move_uploaded_file($file['file']['tmp_name'],$pdf);
                    $array = explode("\\", $pdf);
                    
                    for ($i=0; $i < count($array); $i++)
                    { 
                        if($array[$i]!="FormuTecMatematicasWeb")
                        { 
                            unset($array[$i]);
                        }
                        else
                        {
                            break;
                        }
                    }
                
                    $pdf="http://localhost/".implode ( '/', $array );
                    $response['pdf']=$pdf;
            }
            else
            {
                if($_FILES['file']['size']==0)
                { 
                    $response["big_pdf"]="Tamaño de imagen excedido ";
                    $response['error']=false;
                }
                else
                {
                    $response["pdf_format"]="Formato invalido, solo (PDF) ";
                    $response['error']=false;
                }
               
            }
        
        
        return $response;
    }



}