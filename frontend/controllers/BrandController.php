<?php
/**
 * Created by IntelliJ IDEA.
 * User: apex
 * Date: 18/04/17
 * Time: 11:28 AM
 */

namespace frontend\controllers;


use frontend\models\Brand;
use yii\web\Controller;

class BrandController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index', [
            'result' => Brand::find()->where(['like', 'name', 'wow'])->all()
        ]);
    }

}