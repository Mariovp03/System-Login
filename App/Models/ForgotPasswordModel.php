<?php

namespace Model;

class ForgotPasswordModel extends Model{

    public function getRecoverPasswordByEmail($email)
    {
        $connectBd = $this->conn;
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $resulTreated = $result->fetch_assoc();
        return $resulTreated;
    }

    public function insertTokenRecoverPassword($token, $email)
    {
        $connectBd = $this->conn;
        $sql = "UPDATE users SET recoverPassword = '$token', dateRecoverPassword = NOW(), dateExpireRecoverPassword = DATE_ADD(NOW(), INTERVAL 20 MINUTE) WHERE email = '$email' ";
        $result = $connectBd->query($sql);
        return $result;
    }

    public function selectByToken($token)
    {
        $connectBd = $this->conn;
        $sql = "SELECT * FROM users WHERE recoverPassword = '$token'";
        $result = $this->conn->query($sql);
        $resulTreated = $result->fetch_assoc();
        return $resulTreated;
    }

    public function insertNewPasswordByToken($token, $newPassword)
    {
        $connectBd = $this->conn;
        $newPasswordTreated = password_hash(mysqli_real_escape_string($connectBd, $newPassword), PASSWORD_ARGON2ID);
        $sql = "UPDATE users SET password = '$newPasswordTreated' WHERE recoverPassword = '$token' ";
        $result = $connectBd->query($sql);
        return $result;
    }

    public function cleanToken()
    {
        $connectBd = $this->conn;
        $sql = "UPDATE users SET recoverPassword = NULL WHERE dateExpireRecoverPassword < NOW() ";
        $result = $connectBd->query($sql);
        return $result;
    }
    
}