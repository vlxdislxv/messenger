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