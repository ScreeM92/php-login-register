<?php

class Redirect {
    public static function to($location = null) {
        if($location) {
            if(is_numeric($location)) {
                switch($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        ob_start();
                        include "./views/404.php";
                        $output = ob_get_clean();
                        echo $output;
                        break;
                }
                return;
            }
            header('Location: '. $location);
            exit();
        }
    }
}