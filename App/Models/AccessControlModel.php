<?php

namespace Model;

class AccessControlModel extends Model
{
    public function localizationAcessUser($idUser)
    {
        $sql = "SELECT * FROM users_acess WHERE fk_id = $idUser";

        $result = $this->conn->query($sql);

        $rows = array(); 

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function insertBlockUser($id, $localizationBlock)
    {
        $sql = "INSERT INTO users_acess (fk_id, region_block) VALUES ('$id', '$localizationBlock')";
        return $this->conn->query($sql);
    }
}
