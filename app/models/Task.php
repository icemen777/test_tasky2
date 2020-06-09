<?php

namespace App\Models;

use App\Core\Model;

class Task extends Model
{
    public $id;
    public $userName;
    public $email;
    public $taskText;

    public function fieldsTable(){
        return array(
            'id' => 'Id',
            'username' => 'User name',
            'email' => 'email',
            'tasktext' => 'Task text'
        );
    }
}