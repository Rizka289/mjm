<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InvoiceDetail;


class InvoiceDetailSearch extends InvoiceDetail
{
   
    public function rules()
    {
        return [
            [['id_invoice_detail', 'id_invoice', 'id_spare_part_stok', 'jumlah_transaksi', 'diskon','diskon_persen','setelah_diskon'], 'integer'],
            [['nama_spare_part','no_seri','merk_spare_part'], 'string'],
           
        ];
    }

   
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = InvoiceDetail::find();

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
            'id_invoice_detail' => $this->id_invoice_detail,
            'id_invoice' => $this->id_invoice,
            'id_spare_part_stok' => $this->id_spare_part_stok,
            'jumlah_transaksi' => $this->jumlah_transaksi,
            'diskon' => $this->diskon,
            'diskon_persen' => $this->diskon_persen,
            'setelah_diskon' => $this->setelah_diskon,
        ]);

        return $dataProvider;
    }
}
