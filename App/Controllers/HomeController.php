<?php

namespace Controller;
use Model\HomeModel;

class HomeController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new HomeModel;
    }

    public function index()
    {
        $this->validateTokenUser();
        $this->getViewHome();
    }

    public function getViewHome()
    {
        $pathHomeTreated = PATH_BASE_VIEW . "HomeView.php";
        echo $this->getView($pathHomeTreated, [
            'repositoryData' => $this->consumesGithubApi(),
        ]);
    }

    public function consumesGithubApi()
    {
        $githubUsername = 'mariovp03';
        $apiUrl = "https://api.github.com/users/$githubUsername/repos";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => "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",
        ]);

        $response = curl_exec($ch);
        if ($response !== false) {
            $repos = json_decode($response, true);
            curl_close($ch);
            if(!empty($repos['message'])){
            return[];
            }
            return $repos;
        } else {
            $error = "Erro ao buscar repositórios do GitHub: " . curl_error($ch);
            curl_close($ch);
            return $error;
        }
    }

    public function validateTokenUser(){
        $idUserLogged = $_SESSION['idUserLogged'];

        $ip = $_SERVER['REMOTE_ADDR'];

        $getUserById = $this->model->selectUserById($idUserLogged);

        if($getUserById['tokenOneLogin'] != $ip){
            session_destroy();
            header('Location: ');
        }
    }
}
