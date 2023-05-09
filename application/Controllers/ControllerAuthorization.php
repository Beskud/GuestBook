<?php

namespace Controllers;

use Core\Controller;
use Models\UsersModel;
class ControllerAuthorization extends Controller
{
	public function actionIndex()
	{	
		if (isset($_SESSION['auth']) && $_SESSION['auth']) header("Location: /main");
	
		$this->view->generate('authorization_view.php', 'template_view.php');
	}

	public function actionAuthorization()
	{

		if (isset($_SESSION['auth']) && $_SESSION['auth']) header("Location: /authorization");

		if (isset($_POST['email']) && isset($_POST['password'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$getUser = new UsersModel();
			$user = $getUser->getUser($email,$password);
			
			if ($user && password_verify($password, $user['password'])) {
				if (!empty($user)) {
					$_SESSION['auth'] = true;
					$_SESSION['user_data'] = $user;
				}
				header("Location: /main");
			} else {
				$_SESSION['errors'] = 'Неправильный email или пароль.';
				header("Location:/authorization");
			}	
		}	
	}	
}











?>