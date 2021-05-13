<?php
    class ConnectionBBDD
    {
        var $connect;

        public function __construct()
        {
            require_once('./config.php');
            $this->connect = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

            if(mysqli_connect_errno())
            {
                //echo "Falló la conexión"; 
                $GLOBALS['connect']=null;
            }
            else
            {
                $GLOBALS['connect']=$this->connect;
               // echo "Conexión exitosa ";
               
            }
            
        }
        
    }

?>