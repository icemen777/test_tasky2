<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Task extends \Core\Model
{
    protected static $tbname = 'tasks';

    public $id;
    public $username;
    public $tasktext;
    public $email;
    public $status;

    public function fieldsTable(){
        return array(
            'id' => 'Id',
            'username' => 'User Name',
            'email' => 'E-Mail',
            'tasktext' => 'Text Task',
            'status' => 'Status',
        );
    }

}
