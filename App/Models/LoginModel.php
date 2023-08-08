<?php

namespace Model;

class LoginModel extends Model{

    public function getUser($emailInput, $passwordInput)
    {
        $connectBd = $this->conn;
        $emailTreatedInput = mysqli_real_escape_string($connectBd, $emailInput);
        $passwordTreatedInput = mysqli_real_escape_string($connectBd, $passwordInput);
        $passwordBD = !empty($this->getPasswordByEmailBD($emailTreatedInput)['password']) ? $this->getPasswordByEmailBD($emailTreatedInput)['password'] : "";
        $verifyPasswordInputAndPasswordBD = password_verify($passwordTreatedInput, $passwordBD) ?? '';
        if($verifyPasswordInputAndPasswordBD){
            $sql = "SELECT * FROM users WHERE email = '$emailTreatedInput' AND password = '$passwordBD'";
            $result = $this->conn->query($sql);
            $resulTreated = $result->fetch_assoc();
            return $resulTreated;
        }
        return NULL;
    }

    public function getPasswordByEmailBD($emailInput)
    {
        $connectBd = $this->conn;
        $emailTreatedInput = mysqli_real_escape_string($connectBd, $emailInput);
        $sql = "SELECT password FROM users WHERE email = '$emailTreatedInput'";
        $result = $this->conn->query($sql);
        $resulTreated = $result->fetch_assoc();
        return $resulTreated;
    }
}