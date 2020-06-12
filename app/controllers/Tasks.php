<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Task;
use Respect\Validation\Validator as v;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Tasks extends \Core\Controller
{
    public $item = null;
    public $limit = 3;
    public $page = 1;
    public $message = '';
    private $_offset = 0;
    private $_total = 0;

    /**
     * Show the index page
     */
    public function indexAction()
    {
        $sorting = 'none'; $urlline = '';
        $sortcurs = 'ASC'; // DESC or ASC
        //var_dump($this->route_params); //die();
        if (isset($this->route_params['page'])) {
            $this->page = $this->route_params['page'];
        }
        $select = array(
            'where' => 'id >= 1', // условие
            'order' => 'id '.$sortcurs, // сортируем
            'limit' => $this->limit, // задаем лимит
            'offset' =>  ($this->limit * ($this->page-1))
        );
        $this->_total = Task::GetCountRows();


        if (isset($this->route_params['sorting'])) {
            $sorting = $this->route_params['sorting'];
            $sortcurs = $this->route_params['sortcurs'];
            if ($sorting == 'username'||$sorting == 'email'||$sorting == 'status') {
                if ($sortcurs == 'ASC'||$sortcurs == 'DESC') { $sorting = $sorting.' '.$sortcurs; }
                $select = array(
                    'where' => 'id >= 1', // условие
                    'order' => $sorting, // сортируем
                    'limit' => $this->limit, // задаем лимит
                    'offset' =>  ($this->limit * ($this->page-1))
                );
                $urlline = '&sorting='.$this->route_params['sorting'].'&sortcurs='.$this->route_params['sortcurs'];
            }
        }

        $model = new Task($select); // создаем объект модели
        $models = $model->getAllRows(); // получаем все строки

        //$models = Task::getAll();



        echo $this->template('tasks', array(
            'title' => 'Тестовая страница',
            'pagetitle' => 'Тестовая страница',
            'content' => 'Какой-то контент',
            'sorting' => $sorting,
            'urlline'=> $urlline,
            'items' => $models,
            'message' => $this->message,
            'urlname' => 'tasks',
            'pagination' => $this->getPagination($this->_total, $this->page, $this->limit)
        ), $this);
        return;
    }


   /* Показать одну задачу */
    public function showAction()
    {
        //var_dump($this->route_params); die();
        $model = Task::getById($this->route_params['id'] ?? 1);
        //var_dump($model); die();
        echo $this->template('onetask', array(
            'title' => 'Тестовая страница',
            'pagetitle' => 'Тестовая страница',
            'content' => 'Какой-то контент',
            'item' => $model[0]
        ), $this);
        return;
    }

    public function maketaskAction() {
        $post = $_POST;
        if ($this->validateTask($post)) {
            $model = new Task();
            $model->username = $post['username'];
            $model->email = $post['email'];
            $model->tasktext = $post['tasktext'];
            $model->status = 0;
            $result = $model->save();
            $this->message = '<span class="alert-success">Задача успешно добавлена</span>';
        }
        $this->indexAction();
    }

    public function updateformAction() {
        if ($this->admin) {
            $post = $_POST;
            if ($this->validateTask($post)) {
                $model = new Task();
                if (v::digit()->validate($post['id'])) {
                    $model->id = $post['id'];
                }
                $model->username = $post['username'];
                $model->email = $post['email'];
                $model->tasktext = $post['tasktext'];
                $model->status = $post['status'];
                $result = $model->update();
                $this->message = '<span class="alert-success">Задача успешно обновлена</span>';
            }
            $this->indexAction();
        } else {
            $this->redirect('/loginform/'); return;
        }
    }

    public function edittaskAction() {
        if ($this->admin) {
            $model = Task::getById($this->route_params['id']);
            echo $this->template('updatetask', array(
                'title' => 'Редактирование задачи',
                'pagetitle' => 'Редактирование задачи',
                'content' => '',
                'item' => $model[0]
            ), $this);
            return;
        } else {
            $this->redirect(); return;
        }
    }

    public function validateTask($post) {
        $errortext = array('Неверное имя пользователя', 'Неверный имейл', 'Неверный текст задачи', 'Неверный статус');
        $mes = '';
        $v[0] = v::alnum()->noWhitespace()->length(1, 15)->validate($post['username']);
        $v[1] = v::email()->validate($post['email']);
        $v[2] = v::printable()->length(1, 5000)->validate($post['tasktext']);
        if (isset($post['status'])) {
            $v[3] = v::digit()->validate($post['status']);
        }
        //var_dump($v); //die();
        foreach($v as $k=>$t) {
            if ($t == false) {
                $mes.=$errortext[$k].'<br>';
            }
        }
        if ($mes == '') {
            return true;
        } else {
            $this->message = '<span class="alert-warning">'.$mes.'</span>';
            return false;
        }
    }


}
