<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SuratDetail;

/**
 * SuratDetailSearch represents the model behind the search form of `backend\models\SuratDetail`.
 */
class SuratDetailSearch extends SuratDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_surat_jalan', 'id_spare_part_stok', 'jumlah_transaksi', 'harga_jual', 'diskon', 'diskon_persen', 'setelah_diskon', 'id_login'], 'integer'],
            [['nama_spare_part', 'no_seri', 'merk_spare_part'], 'safe'],
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
        $query = SuratDetail::find();

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
            'id_surat_jalan' => $this->id_surat_jalan,
            'id_spare_part_stok' => $this->id_spare_part_stok,
            'jumlah_transaksi' => $this->jumlah_transaksi,
            'harga_jual' => $this->harga_jual,
            'diskon' => $this->diskon,
            'diskon_persen' => $this->diskon_persen,
            'setelah_diskon' => $this->setelah_diskon,
            'id_login' => $this->id_login,
        ]);

        $query->andFilterWhere(['like', 'nama_spare_part', $this->nama_spare_part])
            ->andFilterWhere(['like', 'no_seri', $this->no_seri])
            ->andFilterWhere(['like', 'merk_spare_part', $this->merk_spare_part]);

        return $dataProvider;
    }
}
