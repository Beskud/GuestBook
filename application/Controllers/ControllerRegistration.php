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

		dump(['121321' => [ 'qewfwerwer' => 1]]);	
		if (isset($_SESSION['auth']) && $_SESSION['auth'])
			header("Location: /main");

		$this->view->generate('registration_view.php', 'template_view.php');
	}

	private function ValidationUserMethod($email, $username, $password, $confirmation_password, $pregPass)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[A-Za-z.@]{1,100}$/', $email)) {
			$_SESSION['error']['email'] = "Invalid email format";
			return false;
		}

		if (!preg_match('/^(?=.*[a-zA-Z])[^\s<>;:\\\\\|\/\[\]\{\}\?\*\(\)\'\"`]{5,25}$/', $username)) {
			$_SESSION['error']['username'] = 'Invalid username format';
			return false;
		}
		
		if ($password != $confirmation_password) {
			$_SESSION['error']['confirmation_password'] = 'Password mismatch';
			return false;
		}

		foreach ($pregPass as $key => $value) {
			if (!preg_match($value, $password)) {
				$_SESSION['error']['password'] = 'The password is not valid. Does not contain ' . $key;
				return false;
			}
			elseif (!preg_match('/^(?=.*[a-zA-Z])[^\s<>;:\\\\\|\/\[\]\{\}\?\*\(\)\'\"`]{5,25}$/', $password)){
				$_SESSION['error']['password'] = 'Password contains prohibited characters';
				return false;
			}
		}
		return true;
	}

	public function actionRegistration()
	{
		$redirect_to = '/authorization';

		if (isset($_SESSION['auth']) && $_SESSION['auth'])
			header("Location: /main");

		$pregPass = [
			'digits' => '@[0-9]@',
			'capital letters' => '#[A-Z]+#',
			'lowercase letters' => '#[a-z]+#'
		];

		if (
			isset($_POST['email']) && isset($_POST['username']) &&
			isset($_POST['password']) && isset($_POST['confirmation_password'])
		) {

			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$confirmation_password = $_POST['confirmation_password'];
		}
	
		$validate = $this->ValidationUserMethod($email, $username, $password, $confirmation_password, $pregPass);
		
		if (!$validate) {
			$redirect_to = '/registration'; 
		} else {
			$setUser = $this->user->setUser($email, $username, $password);
			if (!$setUser) {
				$_SESSION['error']['email'] = 'This email or username already exists';
				$redirect_to = '/registration';
			} 
		}
		header('Location: '.$redirect_to);
	}
}