<?php

class RegisterController {

	public static function view() {
		ob_start();
		include "./views/register.php";
		$output = ob_get_clean();
		echo $output;
	}

	public static function doRegister() {
		if (Input::exists()) {
		    if(Token::check(Input::get('token'))) {
		        $validate = new Validate();
		        $validation = $validate->check($_POST, array(
		            'name' => array(
		                'name' => 'Name',
		                'required' => true,
		                'min' => 2,
		                'max' => 50
		            ),
		            'username' => array(
		                'name' => 'Username',
		                'required' => true,
		                'min' => 2,
		                'max' => 20,
		                'unique' => 'users'
		            ),
		            'email' => array(
		                'name' => 'Email',
		                'required' => true,
		                'min' => 6,
		                'max' => 30,
		                'unique' => 'users'
		            ),
		            'password' => array(
		                'name' => 'Password',
		                'required' => true,
		                'min' => 6
		            ),
		            'password_again' => array(
		                'required' => true,
		                'matches' => 'password'
		            ),
		        ));

		        if ($validate->passed()) {
		            $user = new User();
		            $salt = Hash::salt(32);

		            try {
		            	$userData = [
		                    'name' => Input::get('name'),
		                    'username' => Input::get('username'),
		                    'email' => Input::get('email'),
		                    'password' => Hash::make(Input::get('password'), $salt),
		                    'salt' => $salt,
		                    'joined' => date('Y-m-d H:i:s'),
		                    'group' => 1
		                ];
		                $user->create($userData);

		                Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
		                Redirect::to('/');
		            } catch(Exception $e) {
		                Session::flash('home', $e->getMessage());
		                Redirect::to('/register');
		            }
		        } else {
		        	Session::flash('home', implode(', ', $validate->errors()));
		            Redirect::to('/register');
		        }
		    }
		}
	}
}