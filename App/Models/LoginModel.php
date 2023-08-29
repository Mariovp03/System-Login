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

}
