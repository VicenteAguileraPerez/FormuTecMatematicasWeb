<?php

    class db
    {
        public $connection;
        public $row;
        protected $query;
        protected $show_errors = TRUE;
        protected $query_closed = TRUE;
        public $query_count = 0;

        public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = '', $charset = 'utf8') {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                echo "falló";
               // $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
            }
            $this->connection->set_charset($charset);
        }

        
    }
?>