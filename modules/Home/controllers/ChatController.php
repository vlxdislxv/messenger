<?php


namespace app\modules\home\controllers;

use app\modules\home\models\UserSearch;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class ChatController extends Controller
{
    function beforeAction($action)
    {
        if (!parent::beforeAction($action)) return false;

        Yii::$app->response->format = Response::FORMAT_JSON;

        return Yii::$app->request->isAjax;
    }

    function actionFindChat()
    {
        $searchModel = new UserSearch();

        $data = $searchModel->search(Yii::$app->request->queryParams)->getModels();

        return ['success' => true, 'data' => $data];
    }
}
