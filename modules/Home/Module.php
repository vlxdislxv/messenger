<?php

namespace app\modules\home;

use Yii;
use yii\helpers\Url;

class Module extends \yii\base\Module
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) return false;

        if (Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(Url::to(['/user/login']));
            return false;
        }

        return true;
    }

    public function init()
    {
        parent::init();
    }
}