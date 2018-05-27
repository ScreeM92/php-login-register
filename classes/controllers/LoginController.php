<?php

class LoginController {

	public static function view() {
		ob_start();
		include "./views/login.php";
		$output = ob_get_clean();
		echo $output;
	}

	public static function doLogin() {
		if(Input::exists()) {
		    if(Token::check(Input::get('token'))) {

		        $validate = new Validate();
		        $validation = $validate->check($_POST, array(
		            'username' => array('required' => true),
		            'password' => array('required' => true)
		        ));

		        if($validate->passed()) {
		            $user = new User();

		            $remember = (Input::get('remember') === 'on') ? true : false;
		            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

		            if($login) {
		                Redirect::to('/');
		            } else {
		            	Session::flash('home', 'Incorrect username or password');
		                Redirect::to('/login');
		            }
		        } else {
		        	Session::flash('home', implode(', ', $validate->errors()));
		            Redirect::to('/login');
		        }
		    }
		}
	}

	public static function logout() {
		$user = new User();
		$user->logout();

		Redirect::to('/');
	}
}