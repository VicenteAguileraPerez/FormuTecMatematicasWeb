<?php

class Validations
{
    public function isValidPassword($pass)
    {
        return (strlen($pass) >= 8);
    }
    public function isNotEmpty($dato)
    {
        return !empty($dato);
    }
    public function lenghtValidate($string,$len)
    {
        if(strlen($string)<=$len)
        {
            return true;
        }
        return false;
    }
    public function validateLenght($arrayString,$arrayLenghts)
    {
        $response = array();
        foreach ($arrayString as $key => $value) 
        {
            if(!$this->lenghtValidate($value,$arrayLenghts[$key]))
            {
                $response["error"] = false;
                $response["message"] = "Campo $key debe tener como máximo ".$arrayLenghts[$key]." caracteres";
                break;
            }
        }
        return $response;
    }
    public function validateNotEmpty($arrayString)
    {
        $response = array();
        foreach ($arrayString as $key => $value) 
        {
            if(!$this->isNotEmpty($value))
            {
                $response["error"] = false;
                $response["message"] = "Campo $key está vacío";
                break;
            }
        }
        return $response;
    }
}
