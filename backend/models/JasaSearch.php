<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Jasa;

/**
 * JasaSearch represents the model behind the search form of `backend\models\Jasa`.
 */
class JasaSearch extends Jasa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jasa', 'id_merk', 'harga', 'jumlah'], 'integer'],
            [['nama_jasa', 'tipe', 'alamat'], 'safe'],
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
        $query = Jasa::find();

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
            'id_jasa' => $this->id_jasa,
            'id_merk' => $this->id_merk,
            'harga' => $this->harga,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'nama_jasa', $this->nama_jasa])
            ->andFilterWhere(['like', 'tipe', $this->tipe])
            ->andFilterWhere(['like', 'alamat', $this->alamat]);

        return $dataProvider;
    }
}
