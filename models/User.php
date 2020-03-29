<?php


namespace app\models;
use yii\base\Exception;
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
 * @property string $access_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_login
 * @property string $password write-only password
 */
class User extends UserModel
{

    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset($fields['auth_key'],
            $fields['password_hash'],
            $fields['password_reset_token'],
            $fields['access_token'],
            $fields['created_at'],
            $fields['updated_at']
        );

        return $fields;
    }
    /**
     * @param $token string
     * @param $type string
     * @return User
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @throws Exception
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->getSecurity()->generateRandomString();
    }

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
