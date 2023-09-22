<?php

namespace Model;

class LoginModel extends Model
{
    public function getUser($emailInput, $passwordInput)
    {
        $emailTreatedInput = $this->escapeAndSanitizeInput($emailInput);
        $passwordBD = $this->getPasswordByEmailBD($emailTreatedInput);

        if (!empty($passwordBD)) {
            $verifyPasswordInputAndPasswordBD = password_verify($passwordInput, $passwordBD);

            if ($verifyPasswordInputAndPasswordBD) {
                $sql = "SELECT * FROM users WHERE email = ?";
                $result = $this->executeQuery($sql, [$emailTreatedInput]);
                return $result->fetch_assoc();
            }
        }

        return NULL;
    }

    public function getPasswordByEmailBD($emailInput)
    {
        $emailTreatedInput = $this->escapeAndSanitizeInput($emailInput);
        $sql = "SELECT password FROM users WHERE email = ?";
        $result = $this->executeQuery($sql, [$emailTreatedInput]);
        $resultTreated = $result->fetch_assoc();
        return $resultTreated['password'] ?? "";
    }

    public function insertTokenOnlyOneUser($tokenIp, $idUser)
    {
        $sql = "UPDATE users SET tokenOneLogin = ? WHERE id = ?";
        return $this->executeUpdate($sql, [$tokenIp, $idUser]);
    }

    public function insertLocalizationUser($localization, $idUser)
    {        
        $sql = "INSERT INTO users_acess (localization, fk_id) VALUES ('$localization', $idUser)";
        return $this->conn->query($sql);
    }

    public function quantityLoginForUser($idUser)
    {
        $sql = "SELECT COUNT(*) FROM users_acess WHERE fk_id = $idUser";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function insertQuantityUserAcess($quantity, $id){
        $sql = "UPDATE users SET quantity_login = ? WHERE id = ?";
        return $this->executeUpdate($sql, [$quantity, $id]);
    }
    

}
