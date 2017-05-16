<?php
/**
 * Created by PhpStorm.
 * User: apex
 * Date: 15/05/2017
 * Time: 09:12 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ToastrAsset extends AssetBundle
{
    public $sourcePath = '@bower/toastr';
    public $css = [
        'toastr.min.css'
    ];
    public $js = [
        'toastr.min.js'
    ];
    public $publishOptions = [
        'only' => [
            'toastr.min.js',
            'toastr.min.css'
        ]
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}