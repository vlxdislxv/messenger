<?php


namespace app\modules\user\models;

use app\modules\home\models\CorrespondenceMessage;
use app\modules\home\models\UserCorrespondence;
use yii2mod\user\models\UserModel;
use \yii\db\ActiveQuery;
use Yii;

/**
 * Class User
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_login
 * @property string $password write-only password
 */
class User extends UserModel
{

    /**
     * @param bool $asArray
     * @return array
     */
    public function getAllUserChatsMessages($asArray = false)
    {
        $messages = [];

        // выбираем все чаты юзверя
        $subQ = UserCorrespondence::find()
            ->select('correspondence__id')
            ->andFilterWhere(['=', 'user__id', Yii::$app->user->id]);

        if ($asArray) {
            $messages = CorrespondenceMessage::find()
                ->select('user__id, text, correspondence__id, created_at')
                ->andFilterWhere(['in', 'correspondence__id', $subQ])
                ->orderBy('correspondence__id')
                ->asArray()
                ->all();
        }
        else {
            $messages = CorrespondenceMessage::find()
                ->select('text, correspondence__id, created_at')
                ->andFilterWhere(['in', 'correspondence__id', $subQ])
                ->orderBy('correspondence__id')
                ->all();
        }

        return $messages;
    }

    /**
     * @return ActiveQuery
     */
    public function getCorrespondenceMessages()
    {
        return $this->hasMany(CorrespondenceMessage::className(), ['correspondence__id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserCorrespondences()
    {
        return $this->hasMany(UserCorrespondence::className(), ['user__id' => 'id']);
    }
}
