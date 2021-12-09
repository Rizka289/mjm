<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Unit;

/**
 * UnitSearch represents the model behind the search form of `backend\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit'], 'integer'],
            [['nopol', 'merk_unit', 'pemilik_unit', 'warna_unit'], 'safe'],
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
        $query = Unit::find();

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
            'id_unit' => $this->id_unit,
        ]);

        $query->andFilterWhere(['like', 'nopol', $this->nopol])
            ->andFilterWhere(['like', 'merk_unit', $this->merk_unit])
            ->andFilterWhere(['like', 'pemilik_unit', $this->pemilik_unit])
            ->andFilterWhere(['like', 'warna_unit', $this->warna_unit]);

        return $dataProvider;
    }
}
