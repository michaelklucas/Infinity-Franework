<?php

namespace App\Session\Usuarios;

class Login
{
    private static function initSession()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }


    public static function login($user)
    {
        self::initSession();
        $_SESSION['usuarios'] = [
            'id' => $user->id,
            'nome' => $user->nome,
            'email' => $user->email,
            'pro' => $user->pro
        ];

        return true;
    }

    public static function isLogged()
    {
        self::initSession();
        return isset($_SESSION['usuarios']);
    }

    public static function logout()
    {
        self::initSession();
        unset($_SESSION['usuarios']);
        return true;
    }
    
}
