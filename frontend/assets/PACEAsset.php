<?php
/**
 * Created by IntelliJ IDEA.
 * User: apex
 * Date: 10/04/17
 * Time: 03:29 PM
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class PACEAsset extends AssetBundle
{
    public $sourcePath = '@npm/pace-js';
    public $css = [
        'themes/blue/pace-theme-center-simple.css'
    ];
    public $js = [
        'pace.min.js'
    ];
    public $publishOptions = [
        'only' => [
            'pace.min.js',
            'themes/blue/pace-theme-center-simple.css'
        ]
    ];
}