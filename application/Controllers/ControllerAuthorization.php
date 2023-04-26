<?php

namespace Controllers;

use Core\Controller;
use Models\AuthorizationModel;
class ControllerAuthorization extends Controller
{
	function actionIndex()
	{	
		if (isset($_SESSION['auth']) && $_SESSION['auth']) header("Location: http://guestbook/main");
		$this->view->generate('authorization_view.php', 'template_view.php');
		
	}

	function actionAuthorization()
	{
		if (isset($_SESSION['auth']) && $_SESSION['auth']) header("Location: http://guestbook/authorization");

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
				header("Location: http://guestbook/main");
			} else {
				$error = 'Неправильный email или пароль.';
			}
		}
	}
}	











?>