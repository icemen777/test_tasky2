<?php
namespace App\Core;

use App\Core\View;

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	function action_index()
	{
	}
}