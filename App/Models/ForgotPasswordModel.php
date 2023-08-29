<?php 

namespace Model;

class ForgotPasswordModel extends Model
{
    public function getRecoverPasswordByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = $this->executeQuery($sql, [$email]);
        return $result->fetch_assoc();
    }

    public function insertTokenRecoverPassword($token, $email)
    {
        $sql = "UPDATE users SET recoverPassword = ?, dateRecoverPassword = NOW(), dateExpireRecoverPassword = DATE_ADD(NOW(), INTERVAL 20 MINUTE) WHERE email = ?";
        return $this->executeUpdate($sql, [$token, $email]);
    }

    public function selectByToken($token)
    {
        $sql = "SELECT * FROM users WHERE recoverPassword = ?";
        $result = $this->executeQuery($sql, [$token]);
        return $result->fetch_assoc();
    }

    public function insertNewPasswordByToken($token, $newPassword)
    {
        $newPasswordHashed = password_hash($newPassword, PASSWORD_ARGON2ID);
        $sql = "UPDATE users SET password = ? WHERE recoverPassword = ?";
        return $this->executeUpdate($sql, [$newPasswordHashed, $token]);
    }

    public function cleanToken()
    {
        $sql = "UPDATE users SET recoverPassword = NULL WHERE dateExpireRecoverPassword < NOW()";
        return $this->executeUpdate($sql);
    }

}
