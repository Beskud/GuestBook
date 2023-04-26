<?php

namespace Core;

class Route
{
	static public function start()
	{
		// контроллер и действие по умолчанию
		$controllerName = 'Main';
		$actionName = 'index';
		
        $urlSplit = explode('?', $_SERVER['REQUEST_URI']);
		
        $routes = explode('/', $urlSplit[0]);


        // получаем имя контроллера
		if (!empty($routes[1])) {
			$controllerName = $routes[1];
		}
		
		// получаем имя экшена
		if (!empty($routes[2])) {
			$actionName = $routes[2];
		}

		// добавляем префиксы Controllers\ControllerRegistration
		$controllerName = 'Controllers\Controller'.ucfirst($controllerName);
		$actionName = 'action'.ucfirst($actionName);

		$controller = new $controllerName;
		$action = $actionName;
		
		if (method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action();
		} else {
			// здесь также разумнее было бы кинуть исключение
			 self::ErrorPage404();
		}
	
	}
	
	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }


}