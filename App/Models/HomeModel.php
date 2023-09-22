<?php 

namespace Model;

class HomeModel extends Model
{

    public function selectUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $result = $this->executeQuery($sql, [$id]);
        return $result->fetch_assoc();
    }

}
