<?php

namespace App\Controller\Login;

use App\Model\Entity\User;
use App\Session\Usuarios\Login as SessionLoginUsers;
use App\Utils\View;

class Login
{


    public static function getLogin($request, $errorMessage = null)
    {

        $status = !is_null($errorMessage) ? View::render('pages/Login/Status', [
            'message' => $errorMessage
        ]) : '';

        return View::render('pages/Login/Login', [
            'status' => $status
        ]);
    }

    public static function setLogin($request)
    {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        $obUser = User::getUserByEmail($email);
        if (!$obUser instanceof User) {
            return self::getLogin($request, 'E-mail Inválido');
        }

        if (!password_verify($senha, $obUser->senha)) {
            return self::getLogin($request, 'Senha Inválida');
        }

        SessionLoginUsers::login($obUser);


        $request->getRouter()->redirect('/Home');
    }


    public static function setLogout($request)
    {
        SessionLoginUsers::logout();
        $request->getRouter()->redirect('/');
    }
}
