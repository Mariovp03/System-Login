<?php

namespace Model;

class ForgotPasswordModel extends Model{

    public function getRecoverPassword($email)
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
        $sql = "UPDATE users SET recoverPassword = '$token', dateRecoverPassword = NOW(), dateExpireRecoverPassword = DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE email = '$email' ";
        $result = $connectBd->query($sql);
        return $result;
    }
    
}