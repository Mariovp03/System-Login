<?php

namespace Controller;

use Model\Model;

class Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->createModelInstance();
    }

    protected function createModelInstance()
    {
        return new Model();
    }

    public function getView($pathView, $paramVars)
    {
        if (!file_exists($pathView)) {
            throw new \Exception("A view não existe ou o caminho dela está errado!");
        }
        extract($paramVars);
        ob_start();
        require $pathView;
        return ob_get_clean();
    }
}
