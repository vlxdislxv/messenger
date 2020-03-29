<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'login' => [
                'class' => 'yii2mod\user\actions\LoginAction',
                'view' => 'login',
                'modelClass' => 'app\modules\user\models\LoginForm'
            ],
            'logout' => [
                'class' => 'yii2mod\user\actions\LogoutAction'
            ],
            'signup' => [
                'class' => 'yii2mod\user\actions\SignupAction',
                'modelClass' => 'app\modules\user\models\SignupForm',
                'view' => 'signup'
            ],
//            'request-password-reset' => [
//                'class' => 'yii2mod\user\actions\RequestPasswordResetAction'
//            ],
//            'password-reset' => [
//                'class' => 'yii2mod\user\actions\PasswordResetAction'
//            ],
        ];
    }

    public function render($view, $params = [])
    {
        $flag = $view === 'login' || $view === 'signup';

        if ($flag) return $this->renderPartial($view, $params);

        return parent::render($view, $params);
    }
}
