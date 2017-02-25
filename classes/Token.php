<?php
/**
 * Created by PhpStorm.
 * User: Marthijn
 * Date: 14-1-2017
 * Time: 16:46
 */

class Token {

    public static function generate() {
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token) {
        $tokenName = Config::get('session/token_name');
        if (Session::exists($tokenName) && $token == Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }

}