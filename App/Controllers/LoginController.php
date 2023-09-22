<?php

namespace Controller;

use Model\AccessControlModel;
use Model\ForgotPasswordModel;
use Model\LoginModel;

class LoginController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new LoginModel;
    }

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
                'nameComplet' => "Mário do Vale",
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
                $this->insertQuantityUserAcess($searchUser['id']);
                $this->insertDataLocalization($searchUser['id']);
                $this->insertTokenForUserLogin($emailLoginUser, $passwordLoginUser);
                $insertBlockUserLocalization = $this->insertBlockUserLocalization($searchUser['id']);
                if($insertBlockUserLocalization != false){
                    $this->redirectToHomePage();
                }
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

    public function insertQuantityUserAcess($id)
    {
        $quantity = $this->model->quantityLoginForUser($id)['COUNT(*)'];
        return $this->model->insertQuantityUserAcess($quantity, $id);
    }
    
    public function insertTokenForUserLogin()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $userIdBd = $_SESSION['idUserLogged'];
        return $this->model->insertTokenOnlyOneUser($ip, $userIdBd);
    }

    public function insertDataLocalization($id){
        $region = $this->getUserLocation();
        return $this->model->insertLocalizationUser($region, $id);
    }

    public function insertBlockUserLocalization(){
        $idUser = $_SESSION['idUserLogged'];
        $acessAndBlockLocalization = (new AccessControlModel())->localizationAcessUser($idUser);
        $userLocationNow = $this->getUserLocation();
        foreach($acessAndBlockLocalization as $value){
                if($value['region_block'] == $userLocationNow && !empty($value['region_block'])){
                    (new ForgotPasswordModel())->updatePassword($idUser);
                    echo "Seus dados de acesso foram mudados e sua região foi bloqueada";
                    session_destroy();
                    return false;
                }
        }
        return true;
    }

    public function getUserLocation() {
        $userIp = $_SERVER['REMOTE_ADDR'];
        $url = "https://ipinfo.io/$userIp/json";
        $response = file_get_contents($url);
    
        if ($response !== false) {
            $data = json_decode($response, true);
    
            $region = !empty($data['region']) ? $data['region'] : NULL ;

            if(!empty($region)){
                return $region;
            }else{
                return "localização não está correta devido ao ip bugado";
            }

        } else {
            return "Não foi possível obter a localização";
        }
    }
    
}
