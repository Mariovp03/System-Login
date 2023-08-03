<?php

namespace Model;

use mysqli;

class Model{
    protected $serverName = "localhost";
    protected $userName = "root";
    protected $password = "";
    protected $db_name = "users";
    protected $conn;
    
    public function __construct()
    {
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die("Connect failed. Error:" . $this->conn->connect_error);
        }
    }


}