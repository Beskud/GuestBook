<?php

namespace Controllers;

use Core\Controller;
use Models\AuthorizationModel;
class ControllerAuthorization extends Controller
{
	function actionIndex()
	{	
		$this->view->generate('authorization_view.php', 'template_view.php');
	}

	function actionAuthorization()
	{
		if (isset($_SESSION['auth']) && $_SESSION['auth']) header("Location: index.php");

		if (isset($_POST['email']) && isset($_POST['password'])) {
			
			$email = $_POST['email'];
			$password = $_POST['password'];

			$getUser = new AuthorizationModel();
			$user = $getUser->getUser($email,$password);
			
			if ($user && password_verify($password, $user['password'])) {
			
				if (!empty($user)) {
					$_SESSION['auth'] = true;
					$_SESSION['user_data'] = $user;
				}

				var_dump('auth');
				die();

				header("Location: index.php");
			} else {
				$error = 'Неправильный email или пароль.';
			}
		}
	}
}	











?>