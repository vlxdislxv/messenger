<?php


namespace app\modules\home\controllers;

use app\modules\home\models\CorrespondenceMessage;
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

    function actionSendMessage()
    {
        $model = new CorrespondenceMessage();

        list($success, $data) = $model->saveMessage(Yii::$app->request->post());

        return ['success' => $success, 'data' => $data];
    }

    function actionGetMessages()
    {
        $data = Yii::$app->user->identity->getAllUserChatsMessages(true);

        return ['success' => true, 'current_user' => Yii::$app->user->id, 'data' => $data];
    }
}
