<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Invoice;


class InvoiceSearch extends Invoice
{
    
    public function rules()
    {
        return [
            [['id_invoice', 'jns_pembayaran','id_login'], 'integer'],
            [['tanggal_tagihan', 'tanggal_transaksi', 'keterangan','no_invoice','id_customer','status_tempo'], 'safe'],
        ];
    }

   
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = Invoice::find()->orderBy("id_invoice DESC");
        $query->joinWith(['customer']);
    

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }
         if (
            !is_null($this->tanggal_transaksi) &&
            strpos($this->tanggal_transaksi, ' - ') !== false
        ) {

            list($start_date, $end_date) = explode(' - ', $this->tanggal_transaksi);

            $query->andFilterWhere(['between', 'date(tanggal_transaksi)', $start_date, $end_date]);
        }
        
          if (
            !is_null($this->tanggal_tagihan) &&
            strpos($this->tanggal_tagihan, ' - ') !== false
        ) {

            list($start_date, $end_date) = explode(' - ', $this->tanggal_tagihan);

            $query->andFilterWhere(['between', 'date(tanggal_tagihan)', $start_date, $end_date]);
        }

        $query->andFilterWhere([
            'id_invoice' => $this->id_invoice,
            // 'id_customer' => $this->id_customer,
            // 'tanggal_tagihan' => $this->tanggal_tagihan,
            'status_tempo' => $this->status_tempo,
        ]);

        $query
         ->andFilterWhere(['like', 'customer.nama_customer', $this->id_customer]);
        //  ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
