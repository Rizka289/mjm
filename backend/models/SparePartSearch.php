<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SparePart;


class SparePartSearch extends SparePart
{
   
    public function rules()
    {
        return [
            [['id_spare_part','id_login'], 'integer'],
            [['tanggal_masuk', 'jumlah_belanja','dp', 'tanggal_jatuh_tempo','no_nota_supplier','no_nota_masuk', 'id_supplier','sisa_pembayaran', 'jns_pembayaran','status_tempo'], 'safe'],
            [['no_seri'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SparePart::find()->orderBy('id_spare_part DESC');
        $query->joinWith(['supplier']);

   

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

          if (
            !is_null($this->tanggal_masuk) &&
            strpos($this->tanggal_masuk, ' - ') !== false
        ) {

            list($start_date, $end_date) = explode(' - ', $this->tanggal_masuk);

            $query->andFilterWhere(['between', 'date(tanggal_masuk)', $start_date, $end_date]);
        }
          if (
            !is_null($this->tanggal_jatuh_tempo) &&
            strpos($this->tanggal_jatuh_tempo, ' - ') !== false
        ) {

            list($start_date, $end_date) = explode(' - ', $this->tanggal_jatuh_tempo);

            $query->andFilterWhere(['between', 'date(tanggal_jatuh_tempo)', $start_date, $end_date]);
        }

        $query->andFilterWhere([
            'id_spare_part' => $this->id_spare_part,
            'jumlah_belanja' => $this->jumlah_belanja,
            'jns_pembayaran' => $this->jns_pembayaran,
            'status_tempo' => $this->status_tempo,
           
        ]);
         $query
            // ->andFilterWhere(['like', 'date_format(tanggal_masuk, "%d-%m-%Y")', $this->tanggal_masuk])
            // ->andFilterWhere(['like', 'date_format(tanggal_jatuh_tempo, "%d-%m-%Y")', $this->tanggal_jatuh_tempo])
            // ->andFilterWhere(['like', 'jns_pembayaran', $this->jns_pembayaran])
            ->andFilterWhere(['like', 'supplier.nama_supplier', $this->id_supplier]);

        return $dataProvider;
    }
}
