<?php

namespace app\modules\home\models;

use Yii;
use \yii\db\ActiveQuery;

/**
 * This is the model class for table "correspondence_message".
 *
 * @property int $id
 * @property string $text
 * @property int $correspondence__id
 * @property string|null $created_at
 *
 * @property Correspondence $correspondence
 */
class CorrespondenceMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correspondence_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'correspondence__id'], 'required'],
            [['correspondence__id'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['correspondence__id'], 'exist', 'skipOnError' => true, 'targetClass' => Correspondence::className(), 'targetAttribute' => ['correspondence__id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'correspondence__id' => 'Correspondence ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCorrespondence()
    {
        return $this->hasOne(Correspondence::className(), ['id' => 'correspondence__id']);
    }
}