<?php

class Token {
    public static function generate() {
        return Session::put(Config::get('sessions/token_name'), sha1(uniqid()));
    }

    public static function check($token) {
        $tokenName = Config::get('sessions/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}