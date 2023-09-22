<?php

namespace Controller;
use Model\AccessControlModel;

class AccessControlController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new AccessControlModel;
    }

    public function index()
    {   
        if(isset($_POST['action'])){
            $this->insertBlockUser($_POST['regiao']);
        }
        $this->insertBlockUserLocalization();
        $this->getViewAccessControl();
    }

    public function getViewAccessControl()
    {
        $pathProfileChangeTreated = PATH_BASE_VIEW . "AccessControlView.php";
        echo $this->getView($pathProfileChangeTreated, ['localizationUserAcess' => $this->getlocalizationAcessUser()]);
    }

    public function getlocalizationAcessUser()
    {
        $idUser = $_SESSION['idUserLogged'];
        return $this->model->localizationAcessUser($idUser);
    }

    public function insertBlockUserLocalization(){
        $idUser = $_SESSION['idUserLogged'];
        $acessAndBlockLocalization = $this->model->localizationAcessUser($idUser);
        foreach($acessAndBlockLocalization as $value){
            foreach($acessAndBlockLocalization as $value2){
                if($value['localization'] == $value2['region_block'] && !empty($value2['region_block'])){
                    echo "Sua região foi bloqueada";
                    session_destroy();
                }
            }
        }
    }

    public function insertBlockUser($post){
        $idUser =  $_SESSION['idUserLogged'];
        $this->model->insertBlockUser($idUser, $post);
    }
    
}
