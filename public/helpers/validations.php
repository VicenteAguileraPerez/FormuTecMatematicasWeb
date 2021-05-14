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
}
