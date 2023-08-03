<?php

namespace Controller;


class HomeController extends Controller
{
    public function index(){
        $this->getViewHome();
    }

    public function getViewHome(){
        $pathHomeTreated = PATH_BASE_VIEW . "HomeView.php";
        echo $this->getView(
            $pathHomeTreated ,
            [
                'nameComplet' =>  'Mário do Vale',
            ] 
        );
    }
}