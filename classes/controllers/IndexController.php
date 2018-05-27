<?php

class IndexController {
	public static function view() {
		$user = new User(); //Current
		if($user->isLoggedIn()) {
			ob_start();
			include "./views/home.php";
			$output = ob_get_clean();
			echo $output;
		} else {
			ob_start();
			include "./views/index.php";
			$output = ob_get_clean();
			echo $output;
		}
	}
}