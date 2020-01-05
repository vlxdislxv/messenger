<?php


namespace app\modules\home\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;
use Yii;

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
        $query = User::find()
            ->select('username, correspondence__id')
            ->joinWith('userCorrespondences')
            ->orderBy('user_correspondence.user__id DESC')
            ->asArray();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'username', $this->username.'%', false])
              ->andFilterWhere(['!=', 'username', Yii::$app->user->identity->username]);

        return $dataProvider;
    }
}