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
