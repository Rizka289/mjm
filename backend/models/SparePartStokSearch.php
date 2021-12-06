<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SparePartStok;


class SparePartStokSearch extends SparePartStok
{
   
    public function rules()
    {
        return [
            [['id_spare_part_stok', 'stok','id_spare_part_detail','harga'], 'integer'],
            [[ 'stok','nama_spare_part','merk_spare_part','no_seri','nama_rak'], 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

 
    public function search($params)
    {
        $query = SparePartStok::find()->orderBy("nama_spare_part ASC");
        // $query->where("stok != 0 ");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_spare_part_stok' => $this->id_spare_part_stok,
            'stok' => $this->stok,
            // 'nama_spare_part' => $this->nama_spare_part,
            // 'no_seri' => $this->no_seri,
            'nama_rak' => $this->nama_rak,
           
        ]);
        $query->andFilterWhere(['like', 'nama_spare_part', $this->nama_spare_part])
            ->andFilterWhere(['like', 'no_seri', $this->no_seri])
            // ->andFilterWhere(['like', 'stok', $this->stok])
            // ->andFilterWhere(['like', 'nama_rak', $this->nama_rak])
            ->andFilterWhere(['like', 'merk_spare_part', $this->merk_spare_part])
            ->andFilterWhere(['like', 'harga', $this->harga]);

        return $dataProvider;
    }
}
