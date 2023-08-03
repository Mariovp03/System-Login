<?php

namespace Controller;

use Model\Model;

class Controller{

    public function dataBase()
    {
        return new Model;
    }

    public function getView($pathView, $paramVars){
        if(!file_exists($pathView)){
            die("A view não existe ou o caminho dela está errado!");
        }
        extract($paramVars);
        ob_start();
        require $pathView;
        return ob_get_clean();
    }

}