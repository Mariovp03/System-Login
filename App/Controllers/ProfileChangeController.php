<?php 

namespace Controller;

use Model\ProfileChangeModel;

class ProfileChangeController extends Controller
{
    public function index()
    {
        $this->getViewProfileChange();
    }

    public function getViewProfileChange()
    {
        $pathProfileChangeTreated = PATH_BASE_VIEW . "ProfileChangeView.php";
        $patchArchive = $this->validatePathCorrectArchive();
        echo $this->getView($pathProfileChangeTreated, ['patchArchive' => $patchArchive]);
    }

    public function uploadFile()
    {
        if (!empty($_FILES['file'])) {
            $files = $_FILES['file'];
            $names = $files['name'];
            $tmp_names = $files['tmp_name'];

            $uploadedPaths = [];

            foreach ($names as $index => $name) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $newName = uniqid() . "." . $extension;
                $destination = PATH_BASE_VIEW . "Images/$newName";
                if (move_uploaded_file($tmp_names[$index], $destination)) {
                    $uploadedPaths[] = "Views/Images/$newName";
                }
            }

            return $uploadedPaths;
        }

        return [];
    }

    public function validatePathCorrectArchive()
    {
        $uploadedPaths = $this->uploadFile();

        foreach ($uploadedPaths as $path) {
            if (strpos($path, '.png') !== false) {
                $this->savePathUploadBd($path);
            }
        }

        return $this->getPathUploadBd()['imageProfile'];
    }

    public function savePathUploadBd($pathArchive)
    {
        $profileChangeModel = new ProfileChangeModel();
        $idUserLogged = $_SESSION['idUserLogged'] ?? "";
        $profileChangeModel->savePathUploadBd($pathArchive, $idUserLogged);
    }

    public function getPathUploadBd()
    {
        $profileChangeModel = new ProfileChangeModel();
        $idUserLogged = $_SESSION['idUserLogged'] ?? "";
        return $profileChangeModel->getPathUploadBd($idUserLogged);
    }
}
