<?php

namespace app\controllers;

use app\IRequest;
use app\Router;

class HomeController
{
    public function home()
    {
        return "Home";
    }

    public function about()
    {
        return "about";
    }

    public function contact(\app\IRequest $request,Router $router)
    {
        $data = $request->getBody();
        $errors = [];
        if (!$data['email']) {
            $errors['email'] = "THIS FIELD IS REQUIRED";
        }

        $params = [
            'errors' => $errors,
            'data' => $data
        ];

        echo '<pre>';
        var_dump($params);
        echo '<pre>';

//        if (empty($errors)){
//            header("Location: http://localhost:8080/about");
//        }
        return $router->renderView('contact',$params);
    }


}