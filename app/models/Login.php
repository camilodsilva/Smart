<?php

namespace Smart\Orm;

use Smart\Models\Model as Model;

class Login extends Model
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
}