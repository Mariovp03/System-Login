<?php

namespace Controller;

use Model\LoginModel;

class LoginController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        }

        $this->displayLoginPage();
    }

    public function displayLoginPage()
    {
        $pathLoginTreated = PATH_BASE_VIEW . "LoginView.php";

        echo $this->getView(
            $pathLoginTreated,
            [
                'nameComplet' =>  'Mário do Vale',
            ]
        );
    }

    public function processLogin()
    {
        $loginModel = new LoginModel;

        $emailLoginUser = $_POST['email'] ?? null;
        $passwordLoginUser = $_POST['password'] ?? null;

        if ($emailLoginUser && $passwordLoginUser) {
            $searchUser = $loginModel->getUser($emailLoginUser, $passwordLoginUser);

            if (!empty($searchUser)) {
                $this->setUserSession($searchUser['id']);
                $this->redirectToHomePage();
            }
        }
    }

    public function setUserSession($userId)
    {
        $_SESSION['idUserLogged'] = $userId;
        $_SESSION['userIsLogged'] = true;
    }

    public function redirectToHomePage()
    {
        header('Location: home');
        exit; 
    }
}
