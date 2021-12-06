<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Supplier;

class SupplierSearch extends Supplier
{
   
    public function rules()
    {
        return [
            [['id_supplier', 'no_hp'], 'integer'],
            [['nama_supplier', 'alamat'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

  
    public function search($params)
    {
        $query = Supplier::find()->orderBy('nama_supplier ASC') ;

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
            'id_supplier' => $this->id_supplier,
            'no_hp' => $this->no_hp,
        ]);

        $query->andFilterWhere(['like', 'nama_supplier', $this->nama_supplier])
            ->andFilterWhere(['like', 'alamat', $this->alamat]);

        return $dataProvider;
    }
}
