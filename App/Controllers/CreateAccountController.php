<?php

namespace Controller;

use Model\CreateAccountModel;

class CreateAccountController extends Controller
{
    public function index()
    {
        $this->sendingCreationAccountData();
        $this->getViewCreateAccount();
    }

    public function getViewCreateAccount()
    {
        $pathCreateAccountTreated = PATH_BASE_VIEW . "CreateAccountView.php";
        echo $this->getView($pathCreateAccountTreated, [NULL]);
    }

    public function sendingCreationAccountData()
    {
        $createAccountModel = new CreateAccountModel();

        $email = $_POST['emailCreation'] ?? '';
        $password = $_POST['passwordCreation'] ?? '';

        if (!empty($email) && !empty($password)) {
            $emailAlreadyRegistered = $this->validateSpecificDataForEachUser($email, $createAccountModel);
            
            if (!$emailAlreadyRegistered) {
                echo "Cadastrado com sucesso!";
                $createAccountModel->creationUsers($email, $password);
            } else {
                echo "Esse e-mail já foi cadastrado, gentileza usar outro.";
            }
        }
    }

    public function validateSpecificDataForEachUser($email, $createAccountModel)
    {
        $emailAlreadyRegistered = !empty($createAccountModel->selectEmailAlreadyRegistered($email));
        return $emailAlreadyRegistered;
    }
}
