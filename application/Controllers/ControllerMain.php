<?php

namespace Controllers;
use Core\Controller;
class ControllerMain extends Controller
{
	function actionIndex()
	{	
		$this->view->generate('main_view.php', 'template_view.php');
	}
}