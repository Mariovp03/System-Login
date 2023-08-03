<?php 
require 'Config.php';
require __DIR__ . '/vendor/autoload.php';
require 'Routes/Router.php';
include_once 'Views/HeaderView.php';
session_start();

try{

    $userIsLogged = isset($_SESSION['userIsLogged']) ? true : false;

    if($userIsLogged == true){
        $routeCurrent = $routerIsLogged;
    }else{
        $routeCurrent = $router;
    }
    
    var_dump($userIsLogged);
    
    $uriExplode = explode("/", $_SERVER["REQUEST_URI"]);
    
    $request = $_SERVER['REQUEST_METHOD'];
    
    $paramsGet = explode("?", $uriExplode[3]);
    
    if(!isset($routeCurrent[$request])){
        throw new Exception("A rota não existe!");
    }
    
    if(!array_key_exists($paramsGet[0], $routeCurrent[$request])){
        throw new Exception("A rota não existe!");
    }
    
    $controller = $routeCurrent[$request][$paramsGet[0]]; 
    
    $controller();
    
} catch(Exception $e){

    echo $e->getMessage();

}

include_once 'Views/FooterView.php';

?>
