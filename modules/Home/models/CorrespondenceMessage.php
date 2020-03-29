<?php

namespace app\modules\home\models;

use app\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "correspondence_message".
 *
 * @property int $id
 * @property int $user__id
 * @property int $correspondence__id
 * @property string $text
 * @property string|null $created_at
 *
 * @property Correspondence $correspondence
 */
class CorrespondenceMessage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'correspondence_message';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user__id', 'correspondence__id'], 'required'],
            [['user__id', 'correspondence__id'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 120],
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
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

    public function saveMessage($data)
    {
        $this->load($data);

        $this->user__id = Yii::$app->user->id;

        $exception = false;
        $returnData = null;

        if (!$this->correspondence__id) {
            if (isset($data['receiverName'])) {
                $receiver = User::find()->where('username = :uname', [
                    ':uname' => $data['receiverName']
                ])->one();

                if ($receiver) {
                    $correspondence = new Correspondence();

                    if ($correspondence->createNewChat([Yii::$app->user->identity, $receiver])) {
                        $this->correspondence__id = $correspondence->id;
                        $returnData = ['correspondence__id' => $correspondence->id];
                    } else {
                        $exception = true;
                    }
                }
            } else {
                $exception = true;
            }
        } else {
            $correspondence = UserCorrespondence::find()
                ->andFilterWhere(['=', 'user__id', $this->user__id])
                ->andFilterWhere(['=', 'correspondence__id', $this->correspondence__id])
                ->one();

            $returnData = [];

            // !$correspondence = чат не найден
            $exception = !$correspondence;
        }

        if (!$exception && $this->validate()) {
            $this->save();
        }

        return [!$exception, $returnData];
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