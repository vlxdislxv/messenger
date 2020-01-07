<?php

namespace app\modules\home\models;

use Yii;
use \yii\db\ActiveQuery;

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

        $create = false;

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

    public function isChatExists(array $users)
    {
        $subQ1 = UserCorrespondence::find()
            ->select('id')
            ->andFilterWhere(['in', 'user__id', [$users[0]->id, $users[1]->id]])
            ->groupBy('correspondence__id');

        $subQ2 = UserCorrespondence::find()
            ->select('id')
            ->andFilterWhere(['in', 'user__id', [$users[0]->id, $users[1]->id]]);

        $count1 = UserCorrespondence::find()
            ->from($subQ1)->count();

        $count2 = UserCorrespondence::find()
            ->from($subQ2)->count();

        return $count1 < $count2;
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
        return $this->hasMany(UserCorrespondence::className(), ['correspondence__id' => 'id']);
    }
}