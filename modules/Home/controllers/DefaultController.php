<?php

namespace app\modules\home\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
