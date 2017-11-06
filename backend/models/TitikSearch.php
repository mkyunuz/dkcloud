<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Titik;

/**
 * TitikSearch represents the model behind the search form about `backend\models\Titik`.
 */
class TitikSearch extends Titik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titik_id', 'area_id', 'titik_name', 'created_at', 'updated_at','hor_id'], 'safe'],
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
        $query = Titik::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'titik_id', $this->titik_id])
            ->andFilterWhere(['like', 'area_id', $this->area_id])
            ->andFilterWhere(['like', 'titik_name', $this->titik_name]);

        return $dataProvider;
    }
}
