<?php

class ProfileController {

	public static function view($username) {
		$user = new User($username);

	    if(!$user->exists()) {
	        Redirect::to(404);
	    }

		ob_start();
		include "./views/profile-view.php";
		$output = ob_get_clean();
		echo $output;
	}

	public static function viewEditProfile() {
		ob_start();
		include "./views/profile.php";
		$output = ob_get_clean();
		echo $output;
	}

	public static function updateProfile() {
		$user = new User();

		if(!$user->isLoggedIn()) {
		    Redirect::to('/');
		}

		if(Input::exists()) {
		    if(Token::check(Input::get('token'))) {
		        $validate = new Validate();
		        $validation = $validate->check($_POST, array(
		            'name' => array(
		                'required' => true,
		                'min' => 2,
		                'max' => 50
		            )
		        ));

		        if($validate->passed()) {
		            try {
		                $user->update(array(
		                    'name' => Input::get('name')
		                ));

		                Session::flash('home', 'Your details have been updated.');
		                Redirect::to('/');

		            } catch(Exception $e) {
		                Session::flash('home', $e->getMessage());
		                Redirect::to('/profile');
		            }
		        } else {
		            Session::flash('home', implode(', ', $validate->errors()));
		            Redirect::to('/profile');
		        }
		    }
		}
	}

	public static function viewChangePassword() {
		ob_start();
		include "./views/change-password.php";
		$output = ob_get_clean();
		echo $output;
	}

	public static function changePassword() {
		$user = new User();

		if(!$user->isLoggedIn()) {
		    Redirect::to('/');
		}

		if(Input::exists()) {
		    if(Token::check(Input::get('token'))) {
		        $validate = new Validate();
		        $validation = $validate->check($_POST, array(
		            'current_password' => array(
		                'required' => true,
		                'min' => 6
		            ),
		            'new_password' => array(
		                'required' => true,
		                'min' => 6
		            ),
		            'new_password_again' => array(
		                'required' => true,
		                'min' => 6,
		                'matches' => 'new_password'
		            )
		        ));
		    }

		    if($validate->passed()) {
		        if(Hash::make(Input::get('current_password'), $user->data()->salt) !== $user->data()->password) {
		            Session::flash('home', 'Your current password is wrong.');
		        	Redirect::to('/change-password');
		        } else {
		            $salt = Hash::salt(32);
		            $user->update(array(
		                'password' => Hash::make(Input::get('new_password'), $salt),
		                'salt' => $salt
		            ));

		            Session::flash('home', 'Your password has been changed!');
		            Redirect::to('/');
		        }
		    } else {
		        Session::flash('home', implode(', ', $validate->errors()));
		        Redirect::to('/change-password');
		    }
		}
	}
}