<?php

class HelperEncryptDecrypt
{
    public function __construct()
    {
        
    }

    public function encrypt($datos)
    {
        $datos64=base64_encode(strval(json_encode($datos)));
        
   
        return $datos64;
        //$datos64 = base64_decode($datos64);

    


    }
    public function decrypt($datos64)
    {
        $datos64=json_encode(base64_decode($datos64));
        $json =   json_decode($datos64,true);
        $email = explode(",", substr($json, 1, -1))[2];
        
       
   
        return $email;
    }
}