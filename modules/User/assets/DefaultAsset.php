<?php

namespace app\modules\user\assets;

use \yii\web\AssetBundle;

class DefaultAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/user/web';

    public $css = [
        'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'fonts/iconic/css/material-design-iconic-font.min.css',
        'css/util.css',
        'css/main.css'
    ];

    public $js = [
        'js/main.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}