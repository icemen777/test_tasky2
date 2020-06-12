<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Auth extends \Core\Controller
{
    private $user = 'admin';
    private $password = '123';

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        echo $this->template('home', array(
            'title' => 'Homepage',
            'pagetitle' => 'Homepage',
            'content' => 'Какой-то контент',
        ), $this);
        return;
    }

    public function loginformAction()
    {
        echo $this->template('login', array(
            'title' => 'Login',
            'pagetitle' => 'Login',
            'content' => '',
        ), $this);
        return;
    }

    public function loginAction()
    {
        if ($this->validateUser($_POST))
        {
            $_SESSION['admin']=true;
            header("Location: /");
            return;
        } else {
            header("Location: /loginform/");
            return;
        }

    }

    public function logoutAction() {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            session_destroy();
        }
        header("Location: /");
        return;
    }

    public function validateUser($post) {
        //var_dump($post); die();
        if ($post['user'] == $this->user && $post['password'] == $this->password) {
            return true;
        }
    }
}
