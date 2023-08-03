<?php

namespace Controller;

class ForgotPasswordController extends Controller
{
    public function index(){
        $this->getViewForgotPassword();
    }

    public function getViewForgotPassword(){
        $pathForgotPasswordTreated = PATH_BASE_VIEW . "ForgotPasswordView.php";
        echo $this->getView(
            $pathForgotPasswordTreated ,
            [
                'nameComplet' =>  'Mário do Vale',
            ] 
        );
    }
}