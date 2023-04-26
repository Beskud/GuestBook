<?php

namespace Controllers;

use Core\Controller;
use Models\RegistrationModel;

class ControllerRegistration extends Controller
{
	function actionIndex()
	{
		if (isset($_SESSION['auth']) && $_SESSION['auth'])  header("Location:http://guestbook/main");
		$this->view->generate('registration_view.php', 'template_view.php');
	}

	function actionRegistration()
	{
		if (isset($_SESSION['auth']) && $_SESSION['auth'])  header("Location:http://guestbook/main");
			
		$pregPass = [
			'digits' => '@[0-9]@',
			'capital letters' => '#[A-Z]+#',
			'lowercase letters' => '#[a-z]+#'
		];

		$error_validation = [];

		if (isset($_POST['email']) && isset($_POST['username']) &&
			isset($_POST['password']) && isset($_POST['confirmation_password'])) {

			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confirmation_password = $_POST['confirmation_password'];

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error_validation['email'] = "Invalid email format";
			}
			if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
				$error_validation['username'] = 'Invalid username format';
			}
			if ($password != $confirmation_password) {
				$error_validation['confirmation_password'] = 'Password mismatch';
			}

			foreach ($pregPass as $key => $value) {
				if (!preg_match($value, $password)) {
					$error_validation['password'] = 'The password is not valid. Does not contain ' . $key;
				}
			}

			$registrationModel = new RegistrationModel();
			$setUser = $registrationModel->setUser($email,$username,$password);

			if (!$setUser) {
				$error_validation['email'] = 'This email or username already exists';
			}

			header("Location: http://guestbook/main");
		}
	}
}

