<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SuratJalan;


class SuratJalanSearch extends SuratJalan
{
 
    public function rules()
    {
        return [
            [['id', 'id_kota', 'id_unit', 'id_karyawan', 'id_login', 'status'], 'integer'],
            [['tanggal_pengiriman', 'keterangan','tujuan'], 'safe'],
        ];
    }

  
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
        $query = SuratJalan::find();

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
            'id' => $this->id,
            'id_kota' => $this->id_kota,
            'id_unit' => $this->id_unit,
            'id_karyawan' => $this->id_karyawan,
            'id_login' => $this->id_login,
            'tanggal_pengiriman' => $this->tanggal_pengiriman,
            'tujuan' => $this->tujuan,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
              ->andFilterWhere(['like', 'kota.kota', $this->id_kota])
              ->andFilterWhere(['like', 'unit.nopol', $this->id_unit]);
        return $dataProvider;
    }
     
}
