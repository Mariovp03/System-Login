<?php

namespace Controller;

use Model\ProfileChangeModel;

class ProfileChangeController extends Controller
{
    public function index(){
        $this->getViewProfileChange();
    }

    public function getViewProfileChange(){
        $pathProfileChangeTreated = PATH_BASE_VIEW . "ProfileChangeView.php";
        echo $this->getView(
            $pathProfileChangeTreated ,
            [
                'patchArchive' =>  $this->validatePathCorrectArchive(),
            ] 
        );
    }

    public function uploadFile(){
        if(!empty($_FILES['file'])){
            $files = $_FILES['file'];
            $names = $files['name'];
            $tmp_name = $files['tmp_name'];
            foreach($names as $index => $name){
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $newName = uniqid() . "." . $extension;
                move_uploaded_file($tmp_name[$index], PATH_BASE_VIEW . "Images/$newName");
            }
            $pathArchiveInitial = "Views/Images/" . $newName;
            return $pathArchiveInitial;
        }
        return false;
    }

    public function validatePathCorrectArchive(){
        $pathArchiveInitial = $this->uploadFile();
        if($pathArchiveInitial != false && strpos($pathArchiveInitial, '.png') == true ){
            $saveInBdPathImage = $this->savePathUploadBd($pathArchiveInitial);
        } 
        $getInBdPathImage = $this->getPathUploadBd()['imageProfile'];
        return $getInBdPathImage;
    }

    public function savePathUploadBd($pathArchive){
       $profileChangeModel = new ProfileChangeModel;
       $idUserLogged = !empty($_SESSION['idUserLogged']) ? $_SESSION['idUserLogged'] : "" ;
       return $profileChangeModel->savePathUploadBd($pathArchive, $idUserLogged);
    }

    public function getPathUploadBd(){
        $profileChangeModel = new ProfileChangeModel;
        $idUserLogged = !empty($_SESSION['idUserLogged']) ? $_SESSION['idUserLogged'] : "" ;
        return $profileChangeModel->getPathUploadBd($idUserLogged);
    }
}