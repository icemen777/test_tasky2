<?php

class Controller_Main extends Controller
{
	function action_index()
	{	
		$this->view->generate('main_view.php', 'layout.php');
	}

    function action_page()
    {
        $this->view->generate('page.php', 'layout.php');
    }
}