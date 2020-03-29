<?php


namespace app\modules\home\models;

use yii\base\Model;
use app\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Expression;

/**
 * @property string $username
 */
class UserSearch extends Model
{

    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['username'], 'required'],
            ['username', 'string', 'max' => 255],
        ];
    }

    /**
     * @param array $params
     * @throws InvalidConfigException
     * @return array
     */
    public function search($params)
    {
        if (!$this->load($params) || !$this->validate()) {
            return [];
        }

        /* @var User $currUser */
        $currUser = Yii::$app->user->identity;

        if (!empty($this->username)) { // поиск по пользователям

            $correspondencesQuery = $currUser->getCorrespondences()
                ->select('correspondence__id'); // переписки пользователя

            $query1 = User::find() // пользователи, с которыми есть переписка
                ->select('user.id as id, username, correspondence__id')
                ->joinWith('correspondences')
                ->andFilterWhere(['!=', 'user__id', $currUser->id])
                ->andFilterWhere(['in', 'correspondence__id', $correspondencesQuery])
                ->andFilterWhere(['like', 'username', $this->username.'%', false])
                ->asArray();

            $query2 = User::find()
                ->select(['user.id as id', 'username', new Expression('(NULL) AS correspondence__id')])
                ->asArray();

            $query2->andFilterWhere(['like', 'username', $this->username.'%', false]);
            $query2->andFilterWhere(['!=', 'username', $currUser->username]);

            $query1 = $query1->union($query2);

            return $query1->all();

        } else { // выбрать контакты (тех с кем есть переписка)

            $correspondencesQuery = $currUser->getCorrespondences()
                ->select('correspondence__id'); // переписки пользователя

            $query = User::find() // пользователи, с которыми есть переписка
                ->select('user.id as id, username, correspondence__id')
                ->joinWith('correspondences', false)
                ->andFilterWhere(['!=', 'user.id', $currUser->id])
                ->andFilterWhere(['in', 'correspondence__id', $correspondencesQuery])
                ->asArray();

            return $query->all();
        }
    }
}