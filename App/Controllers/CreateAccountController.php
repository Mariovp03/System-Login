<?php

namespace Controller;

use Model\CreateAccountModel;

class CreateAccountController extends Controller
{
    public function index(){
        $this->sendingCreationAccountData();
        $this->getViewCreateAccount();
    }

    public function getViewCreateAccount(){
        $pathCreateAccountTreated = PATH_BASE_VIEW . "CreateAccountView.php";
        echo $this->getView(
            $pathCreateAccountTreated ,
            [
                NULL,
            ] 
        );
    }

    public function sendingCreationAccountData(){
        $createAccountModel = new CreateAccountModel;
        $email = !empty($_POST['emailCreation']) ? $_POST['emailCreation'] : "";
        $password = !empty($_POST['passwordCreation']) ? $_POST['passwordCreation'] : "";
        $emailAlreadyRegister = $this->validateSpecificDataForEachUser();
        if(!empty($email) && !empty($password)){
            if($emailAlreadyRegister == false){
                echo "Cadastrado com sucesso!";
                return $createAccountModel->creationUsers($email, $password);
            }
            echo "Esse e-mail já foi cadastrado, gentileza usar outro.";
            return false;
        }
    }

    public function validateSpecificDataForEachUser(){
        $createAccountModel = new CreateAccountModel;
        $email = !empty($_POST['emailCreation']) ? $_POST['emailCreation'] : NULL;
        $emailAlreadyRegister = !empty($createAccountModel->selectEmailAlreadyRegistered($email)) ? true : false;
        return $emailAlreadyRegister;
    }
}