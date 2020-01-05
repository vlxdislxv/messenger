<?php

namespace app\modules\home\assets;

use \yii\web\AssetBundle;

class DefaultAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/home/web';

    public $css = [
        'fontawesome/css/all.min.css',
        'css/style.css',
    ];

    public function init()
    {
        parent::init();

        \Yii::$app->assetManager->bundles['yii\\web\\JqueryAsset'] = [
            'js' => ['jquery.slim.min.js']
        ];
    }

    public $js = [
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset'
    ];
}