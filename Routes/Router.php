<?php
function load($controller, $action){
    try{
        
        $controllerNamespace = "Controller\\$controller";
        
        if(!class_exists($controllerNamespace)){
            throw new Exception("A $controller não existe!");
        }
        
        $controllerInstance = new $controllerNamespace();
        
        if(!method_exists($controllerInstance, $action)){
            throw new Exception("O método $action não existe na controller $controller!");
        }
        
        $controllerInstance->$action();
    }catch(Exception $e){
    
        $e->getMessage();
    
    }
    
}



    $router = [
        "GET" => [
            "" => fn() => load("LoginController", "index"),
            "create-account" => fn() => load("CreateAccountController", "index"),
            "forgot-password" => fn() => load("ForgotPasswordController", "index"),
        ],
        "POST" => [
            "" => fn() => load("LoginController", "index"),
            "create-account" => fn() => load("CreateAccountController", "index"),
        ],
    ];

    $routerIsLogged = [
        "GET" => [
            "home" => fn() => load("HomeController", "index"),
        ],
        "POST" => [
        ],
    ];
