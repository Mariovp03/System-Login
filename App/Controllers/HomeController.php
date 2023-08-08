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
                'repositoryData' =>  $this->consumesGithubApi()
            ] 
        );
    }

    public function consumesGithubApi(){
        $myToken = "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";

        $githubUsername = 'mariovp03';

        $apiUrl = "https://api.github.com/users/$githubUsername/repos";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $myToken);
        $response = curl_exec($ch);
        
        if ($response !== false) {
            $repos = json_decode($response, true);
            return $repos;
        } else {
            return "Erro ao buscar repositórios do GitHub: " . curl_error($ch);
        }
        curl_close($ch);
    }
    
}