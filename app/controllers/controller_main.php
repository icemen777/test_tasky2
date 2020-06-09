<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;


class Controller_Main extends Controller
{
	function action_index()
	{	
		$this->view->generate('main_view.php', 'layout.php');
	}

    function action_page()
    {
        $model = new Task();
        $data = $model->getTableName();

        $this->view->generate('page.php', 'layout.php', $data);
    }
}