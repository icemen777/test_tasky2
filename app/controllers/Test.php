<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Test extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        echo $this->template('test', array(
            'title' => 'Тестовая страница',
            'pagetitle' => 'Тестовая страница',
            'content' => 'Какой-то контент',
        ), $this);
        return;
    }
}
