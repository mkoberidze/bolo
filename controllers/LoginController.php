<?php


namespace app\controllers;
use app\database\database;
use app\Router;

class LoginController
{
    public function login(\app\IRequest $request, Router $router)
    {
        session_start();
        define('REQUIRED_FIELD_ERROR', 'This field is required');
        $data = $request->getBody();

        $errors = [];

        $insert = new database();
        $info1 = $insert->getUser($data['username'],$data['userpassword']);

        if (!$data['username']) {
            $errors['username'] = REQUIRED_FIELD_ERROR;
        }

        if (!$data['userpassword']) {
            $errors['userpassword'] = REQUIRED_FIELD_ERROR;
        }


        $params = [
            'errors' => $errors,
            'data' => $data
        ];

        if($info1 == 'true') {
            return $router->renderView('/', $params);
        } else{
            return $router->renderView('login', $params);
        }

    }
}