<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SparePartDetail;


class SparePartDetailSearch extends SparePartDetail
{
    
    public function rules()
    {
        return [
            [['id_spare_part_detail', 'id_nama_spare_part', 'id_merk_spare_part', 'id_spare_part', 'harga_beli', 'harga_jual'], 'integer'],
            [[ 'harga_beli', 'harga_jual'], 'safe'],
        ];
    }

   
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

  
    public function search($params)
    {
        $query = SparePartDetail::find();

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
            'id_spare_part_detail' => $this->id_spare_part_detail,
            'id_nama_spare_part' => $this->id_nama_spare_part,
            'id_merk_spare_part' => $this->id_merk_spare_part,
            'id_spare_part' => $this->id_spare_part,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->harga_jual,
        ]);

        return $dataProvider;
    }
}
