<?php

namespace app\modules\api;

use Yii;
use yii\web\Response;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;
        Yii::$app->urlManager->addRules([
            'class' => 'yii\rest\UrlRule',
            'controller' => 'user'
        ],false);
        Yii::$app->urlManager->enableStrictParsing = true;
        Yii::$app->urlManager->showScriptName = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->request->parsers = ['application/json' => 'yii\web\JsonParser'];
    }
}