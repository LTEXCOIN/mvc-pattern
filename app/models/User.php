<?php

namespace app\models;

use app\system\Model;
use PDO;

class User extends Model
{
    protected $table = 'users';

    public function getUsers()
    {
        $statement = $this
            ->select('*')
            ->get(PDO::FETCH_OBJ);
        echo '<pre>';
        print_r(get_included_files());

        exit;
    }

}