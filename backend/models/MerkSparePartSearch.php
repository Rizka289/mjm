<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MerkSparePart;


class MerkSparePartSearch extends MerkSparePart
{
   
    public function rules()
    {
        return [
            [['id_merk'], 'integer'],
            [['nama_merk'], 'safe'],
        ];
    }

  
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = MerkSparePart::find()->orderBy('nama_merk ASC');


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
            'id_merk' => $this->id_merk,
        ]);

        $query->andFilterWhere(['like', 'nama_merk', $this->nama_merk]);

        return $dataProvider;
    }
}
