<?php

namespace Controllers;

use Core\Controller;
use Models\UsersModel;

class ControllerRegistration extends Controller
{
	public $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = new UsersModel();
	}

	public function actionIndex()
	{
		if (isset($_SESSION['auth']) && $_SESSION['auth'])  header("Location:http://guestbook/main");

		$this->view->generate('registration_view.php', 'template_view.php');
	}
	
	private function ValidationUserMethod($email,$username,$password,$confirmation_password,$pregPass) 
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error']['email'] = "Invalid email format";
			header("Location: http://guestbook/registration");
		}
		if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
			$_SESSION['error']['username'] = 'Invalid username format';
			header("Location: http://guestbook/registration");
		}
		if ($password != $confirmation_password) {
			$_SESSION['error']['confirmation_password'] = 'Password mismatch';
			header("Location: http://guestbook/registration");
		}

		foreach ($pregPass as $key => $value) {
			if (!preg_match($value, $password)) {
				$_SESSION['error']['password'] = 'The password is not valid. Does not contain ' . $key;
				header("Location: http://guestbook/registration");
			}
		}
	}
	public function actionRegistration()
	{	
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
			}

	
		$this->ValidationUserMethod($email,$username,$password,$confirmation_password,$pregPass);

		if (isset($_SESSION['auth']) && $_SESSION['auth'])  header("Location:http://guestbook/main");
		

		$setUser = $this->user->setUser($email,$username,$password);

		if (!$setUser) {
			$_SESSION['error']['email'] = 'This email or username already exists';
			header("Location: http://guestbook/registration");
		} else {
			header("Location: http://guestbook/main");	
		}		
	}
}


