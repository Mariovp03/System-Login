<?php

namespace Model;

class LoginModel extends Model{

    public function getUser($email, $password)
    {
        $connectBd = $this->conn;
        $emailTreated = mysqli_real_escape_string($connectBd, $email);
        $passwordTreated = mysqli_real_escape_string($connectBd, $password);
        $sql = "SELECT * FROM users WHERE email = '$emailTreated' AND password = '$passwordTreated'";
        $result = $this->conn->query($sql);
        $resulTreated = $result->fetch_assoc();
        return $resulTreated;
    }
}