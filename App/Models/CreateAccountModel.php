<?php

namespace Model;

class CreateAccountModel extends Model
{
    public function creationUsers($email, $password)
    {
        $emailTreated = $this->escapeAndSanitizeInput($email);
        $passwordTreated = $this->hashPassword($password);
        $sql = "INSERT INTO users (email, password) VALUES ('$emailTreated', '$passwordTreated')";
        return $this->conn->query($sql);
    }

    public function selectEmailAlreadyRegistered($email)
    {
        $emailTreated = $this->escapeAndSanitizeInput($email);
        $sql = "SELECT * FROM users WHERE email = '$emailTreated'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    protected function escapeAndSanitizeInput($input)
    {
        $connectBd = $this->conn;
        $inputEscaped = mysqli_real_escape_string($connectBd, $input);
        return $inputEscaped;
    }

    protected function hashPassword($password)
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}
