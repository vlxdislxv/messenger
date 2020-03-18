<?php


namespace app\modules\user\models;

use yii\base\InvalidConfigException;
use app\modules\home\models\Correspondence;
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
     * @throws InvalidConfigException
     * @return array
     */
    public function getAllUserChatsMessages($asArray = false)
    {
        // выбираем все чаты юзверя
        $subQ = $this->getCorrespondences()->select('correspondence__id');

        $messages = CorrespondenceMessage::find()
            ->select('user__id, text, correspondence__id, created_at')
            ->andFilterWhere(['in', 'correspondence__id', $subQ]);

        if ($asArray) {
            $messages->asArray();
        }

        return $messages->all();
    }

    /**
     * @return ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(CorrespondenceMessage::className(), ['user__id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getCorrespondences()
    {
        return $this->hasMany(Correspondence::className(), ['id' => 'correspondence__id'])
            ->viaTable('user_correspondence', ['user__id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserCorrespondences()
    {
        return $this->hasMany(UserCorrespondence::className(), ['user__id' => 'id']);
    }
}
