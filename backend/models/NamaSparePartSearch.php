<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NamaSparePart;

class NamaSparePartSearch extends NamaSparePart
{
    
    public function rules()
    {
        return [
            [['id_nama_spare_part'], 'integer'],
            [['nama_spare_part','no_seri','stok_minimal','nama_rak'], 'safe'],
        ];
    }

    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = NamaSparePart::find()->orderBy('nama_spare_part ASC');

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
            'id_nama_spare_part' => $this->id_nama_spare_part,
        ]);

        $query->andFilterWhere(['like', 'nama_spare_part', $this->nama_spare_part])
        ->andFilterWhere(['like', 'no_seri', $this->no_seri])
        ->andFilterWhere(['like', 'nama_rak', $this->nama_rak]);

        return $dataProvider;
    }
}
