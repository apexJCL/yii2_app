<?php

namespace frontend\controllers;


use yii\web\Controller;

class UserController extends Controller
{

    /**
     * Acción que cuando se entre a la URL
     * /user/profile mostrará en pantalla
     * la cadena "Hola"
     *
     * @return string
     */
    public function actionProfile()
    {
        return "Hola";
    }

    /**
     * Acción que responde a la URL
     * /user o /user/index
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'mensaje' => 'Bienvenido'
        ]);
    }

}