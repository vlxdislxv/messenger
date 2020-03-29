<?php

namespace app\modules\home\models;

use Yii;
use app\models\User;
use \yii\db\ActiveQuery;

/**
 * This is the model class for table "user_correspondence".
 *
 * @property int $id
 * @property int $user__id
 * @property int $correspondence__id
 *
 * @property Correspondence $correspondence
 * @property User $user
 */
class UserCorrespondence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_correspondence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user__id', 'correspondence__id'], 'required'],
            [['user__id', 'correspondence__id'], 'integer'],
            [['correspondence__id'], 'exist', 'skipOnError' => true, 'targetClass' => Correspondence::className(), 'targetAttribute' => ['correspondence__id' => 'id']],
            [['user__id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user__id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user__id' => 'User ID',
            'correspondence__id' => 'Correspondence ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCorrespondence()
    {
        return $this->hasOne(Correspondence::className(), ['id' => 'correspondence__id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user__id']);
    }
}