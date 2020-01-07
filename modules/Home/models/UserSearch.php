<?php


namespace app\modules\home\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;
use Yii;
use yii\db\Expression;

class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);


        if ($this->username !== '') { // поиск по пользователям

            $subQ1 = UserCorrespondence::find()
                ->select('correspondence__id')
                ->andFilterWhere(['=', 'user__id', Yii::$app->user->id]);

            $query1 = User::find()
                ->select('username, correspondence__id')
                ->joinWith('userCorrespondences')
                ->andFilterWhere(['!=', 'user__id', Yii::$app->user->id])
                ->andFilterWhere(['in', 'correspondence__id', $subQ1])
                ->andFilterWhere(['like', 'username', $this->username.'%', false])
                ->asArray();

            $query = User::find()
                ->select(['username', new Expression('(NULL) AS correspondence__id')])
                ->asArray();

            $subQ = User::find()
                ->select('user__id')
                ->joinWith('userCorrespondences')
                ->andFilterWhere(['!=', 'user__id', Yii::$app->user->id])
                ->andFilterWhere(['in', 'correspondence__id', $subQ1])
                ->asArray();

            $query->andFilterWhere(['like', 'username', $this->username.'%', false]);
            $query->andFilterWhere(['!=', 'username', Yii::$app->user->identity->username]);
            $query->andFilterWhere(['not in', 'id', $subQ]);

            // add conditions that should always apply here

            $query1 = $query1->union($query);

            $dataProvider = new ActiveDataProvider([
                'query' => $query1,
                'pagination' => [
                    'pageSize' => 10
                ],
            ]);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                $query->where('0=1');
                return $dataProvider;
            }

            return $dataProvider;
        } else { // выбрать контакты (тех с кем есть переписка)
            $subQ = UserCorrespondence::find()
                ->select('correspondence__id')
                ->andFilterWhere(['=', 'user__id', Yii::$app->user->id]);

            $query = User::find()
                ->select('username, correspondence__id')
                ->joinWith('userCorrespondences')
                ->andFilterWhere(['!=', 'user__id', Yii::$app->user->id])
                ->andFilterWhere(['in', 'correspondence__id', $subQ])
                ->asArray();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10
                ],
            ]);

            return $dataProvider;
        }
    }
}