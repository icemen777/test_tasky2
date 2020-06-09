<?php
namespace App\Controllers;

use App\Core\Controller;

class Controller_404 extends Controller
{
	
	function action_index()
	{
		$this->view->generate('404_view.php', 'layout.php');
	}

}
