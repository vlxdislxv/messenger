<?php

namespace app\modules\home\models;

use app\modules\user\models\User;
use yii\base\InvalidConfigException;
use Yii;
use \yii\db\ActiveQuery;
use yii\db\Exception;

/**
 * This is the model class for table "correspondence".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property CorrespondenceMessage[] $correspondenceMessages
 * @property UserCorrespondence[] $userCorrespondences
 */
class Correspondence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correspondence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function createNewChat(array $users)
    {
        // для 2 пользователей

        if ($create = !$this->isChatExists($users)) {
            if ($create = $this->save()) {
                foreach ($users as $user) {
                    $userCorrespondence = new UserCorrespondence();

                    $userCorrespondence->user__id = $user->id;
                    $userCorrespondence->correspondence__id = $this->id;

                    $userCorrespondence->save();
                }
            }
        }

        return $create;
    }

    /**
     * @param User[] $users
     * @return bool
     */
    public function isChatExists(array $users)
    {
        // чат может быть только между 2 пользователями, больше = беседа
        $usersIDs = [];

        foreach ($users as $user) {
            $usersIDs[] = $user->id;
        }

        $count1 = UserCorrespondence::find()
            ->select('id')
            ->andFilterWhere(['in', 'user__id', $usersIDs])
            ->groupBy('correspondence__id')
            ->count();

        $count2 = UserCorrespondence::find()
            ->select('id')
            ->andFilterWhere(['in', 'user__id', $usersIDs])
            ->count();

        return $count1 < $count2;
    }

    /**
     * @return ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(CorrespondenceMessage::className(), ['correspondence__id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user__id'])
            ->viaTable('user_correspondence', ['correspondence__id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUserCorrespondences()
    {
        return $this->hasMany(UserCorrespondence::className(), ['correspondence__id' => 'id']);
    }
}