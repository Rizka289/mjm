<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;


class CustomerSearch extends Customer
{
    
    public function rules()
    {
        return [
            [['id_customer', 'no_telp'], 'integer'],
            [['nama_customer', 'alamat','kota'], 'safe'],
        ];
    }

  
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

  
    public function search($params)
    {
        $query = Customer::find()->orderBy('nama_customer ASC');

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
            'id_customer' => $this->id_customer,
            // 'no_telp' => $this->no_telp,
        ]);

        $query->andFilterWhere(['like', 'nama_customer', $this->nama_customer])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kota', $this->kota])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp]);

        return $dataProvider;
    }
}
