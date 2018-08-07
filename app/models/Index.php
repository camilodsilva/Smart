<?php

namespace Smart\Orm;

use Smart\Models\Model as Model;

class Index extends Model
{
    public function getUsers()
    {
        try {
            $sql    = 'SELECT * FROM usuarios';
            $result = $this->db->select($sql);

            return $result;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserDetail($id)
    {
        try {
            $sql    = 'SELECT * FROM usuarios WHERE userId = :userId';
            $result = $this->db->select($sql, array('userId' => $id));

            return $result;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}