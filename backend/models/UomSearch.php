<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Uom;


class UomSearch extends Uom
{
    
    public function rules()
    {
        return [
            [['id_uom'], 'integer'],
            [['uom'], 'safe'],
        ];
    }

 
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = Uom::find()->orderBy('id_uom DESC');

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
            'id_uom' => $this->id_uom,
        ]);

        $query->andFilterWhere(['like', 'uom', $this->uom]);

        return $dataProvider;
    }
}
