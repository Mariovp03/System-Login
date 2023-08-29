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

    protected function executeQuery($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    protected function executeUpdate($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        return $stmt->execute();
    }

    protected function escapeAndSanitizeInput($input)
    {
        $connectBd = $this->conn;
        $inputEscaped = mysqli_real_escape_string($connectBd, $input);
        return $inputEscaped;
    }

}