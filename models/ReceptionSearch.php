<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reception;
use app\models\Users;

/**
 * ReceptionSearch represents the model behind the search form of `app\models\Reception`.
 */
class ReceptionSearch extends Reception
{
    public $timeReal;
    public $userNameReal;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_id', 'status_id', 'operator_id', 'user_id'], 'integer'],
            [['date', 'record', 'timeReal', 'userNameReal'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Reception::find();
        $query->joinWith(['user']);
        $query->joinWith(['time']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 28,
            ],
        ]);

        $dataProvider->sort->attributes['userNameReal'] = [
            'asc' => [Users::tableName().'.last_name' => SORT_ASC],
            'desc' => [Users::tableName().'.last_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['timeReal'] = [
            'asc' => [Time::tableName().'.time' => SORT_ASC],
            'desc' => [Time::tableName().'.time' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'time_id' => $this->time_id,
            'date' => $this->date,
            'status_id' => $this->status_id,
            'operator_id' => $this->operator_id,
            'user_id' => $this->user_id,
        ])
        ->andFilterWhere(['like', 
            Time::tableName().'.time', 
            $this->timeReal,
        ])
        ->andFilterWhere(['like', 
            Users::tableName().'.last_name', 
            $this->userNameReal,
        ]);
        return $dataProvider;
    }
}
