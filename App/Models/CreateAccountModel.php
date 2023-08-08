<?php

namespace Model;

class CreateAccountModel extends Model{

    public function creationUsers($email, $password)
    {
        $connectBd = $this->conn;
        $emailTreated = mysqli_real_escape_string($connectBd, $email);
        $passwordTreated = password_hash(mysqli_real_escape_string($connectBd, $password), PASSWORD_ARGON2ID);
        $sql = "INSERT INTO users (email, password) VALUES ('$emailTreated', '$passwordTreated')";
        $result = $connectBd->query($sql);

        return $result;
    }
    
    public function selectEmailAlreadyRegistered($email)
    {
        $connectBd = $this->conn;
        $emailTreated = mysqli_real_escape_string($connectBd, $email);
        $sql = "SELECT * FROM users WHERE email = '$emailTreated'";
        $result = $connectBd->query($sql);
        $resultTreated = $result->fetch_assoc();
        return $resultTreated;
    }
}