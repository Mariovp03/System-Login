<?php

namespace Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->getViewHome();
    }

    public function getViewHome()
    {
        $pathHomeTreated = PATH_BASE_VIEW . "HomeView.php";
        echo $this->getView($pathHomeTreated, [
            'repositoryData' => $this->consumesGithubApi() ,
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
            return $repos;
        } else {
            $error = "Erro ao buscar repositórios do GitHub: " . curl_error($ch);
            curl_close($ch);
            return $error;
        }
    }
}
