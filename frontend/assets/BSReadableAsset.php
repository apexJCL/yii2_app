<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class BSReadableAsset extends AssetBundle
{

    public $sourcePath = "@vendor/thomaspark/bootswatch/readable";
    public $css = [
        'bootstrap.min.css'
    ];
    public $publishOptions = [
        'only' => [
            'bootstrap.min.css'
        ]
    ];
    public $depends = [
        '\yii\bootstrap\BootstrapAsset'
    ];

}