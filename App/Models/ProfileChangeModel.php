<?php

namespace Model;

class ProfileChangeModel extends Model{

    public function savePathUploadBd($pathArchive, $idUserLogged)
    {
        $connectBd = $this->conn;
        $archiveTreated = mysqli_real_escape_string($connectBd, $pathArchive);
        $sql = "UPDATE users SET imageProfile = '$archiveTreated' WHERE id = $idUserLogged ";
        $result = $connectBd->query($sql);
        return $result;
    }

    public function getPathUploadBd($idUserLogged)
    {
        $connectBd = $this->conn;
        $sql = "SELECT imageProfile FROM users WHERE id = $idUserLogged";
        $result = $connectBd->query($sql);
        $resulTreated = $result->fetch_assoc();
        return $resulTreated;
    }

}