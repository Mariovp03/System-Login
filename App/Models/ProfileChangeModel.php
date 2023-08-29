<?php

namespace Model;

class ProfileChangeModel extends Model
{
    public function savePathUploadBd($pathArchive, $idUserLogged)
    {
        $archiveTreated = $this->escapeAndSanitizeInput($pathArchive);
        $sql = "UPDATE users SET imageProfile = ? WHERE id = ?";
        return $this->executeUpdate($sql, [$archiveTreated, $idUserLogged]);
    }

    public function getPathUploadBd($idUserLogged)
    {
        $sql = "SELECT imageProfile FROM users WHERE id = ?";
        $result = $this->executeQuery($sql, [$idUserLogged]);
        $resultTreated = $result->fetch_assoc();
        return $resultTreated;
    }
}
