<?php

namespace Controller;

use Model\LoginModel;

class LoginController extends Controller
{
    public function index(){
        
        $this->dataUser();
        $this->getViewLogin();
    }

    public function getViewLogin(){
        $pathLoginTreated = PATH_BASE_VIEW . "LoginView.php";

        echo $this->getView(
            $pathLoginTreated ,
            [
                'nameComplet' =>  'Mário do Vale',
            ] 
        );
        
    }

    public function dataUser(){
        $loginModel = new LoginModel;
        $emailLoginUser = !empty($_POST['email']) ? $_POST['email'] : NULL;
        $passwordLoginUser = !empty($_POST['password']) ? $_POST['password'] : NULL;
        $searchUser = $loginModel->getUser($emailLoginUser, $passwordLoginUser);
        if(!empty($searchUser)){
            $_SESSION['userIsLogged'] = true;
            header('location: home');
        }
    }
}