<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id_invoice
 * @property int $id_customer
 * @property string $tanggal_tagihan
 * @property string $tanggal_transaksi
 * @property string $keterangan
 * @property int $status
 */
class Invoice extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'invoice';
    }

   
    public function rules()
    {
        return [
            [['id_customer','jns_pembayaran'], 'required'],
            [['id_customer','id_login','dp','jumlah_belanja','sisa_pembayaran'], 'integer'],
            [['tanggal_tagihan', 'tanggal_transaksi','no_invoice','status_tempo'], 'safe'],
            [['keterangan'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_invoice' => 'Id Invoice',
            'id_customer' => 'Nama Customer',
            'tanggal_tagihan' => 'Tanggal Tagihan',
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'keterangan' => 'Keterangan',
            'jns_pembayaran' => 'Jenis Pembayaran',
            'no_invoice' => 'No. Invoice',
            'dp' => 'Dp / Jumlah Yang Sudah Dibayar',
            'jumlah_belanja' => 'Jumlah Belanja',
            'sisa_pembayaran' => 'Sisa Pembayaran',
        ];
    }
     public function getcustomer()
    {
        return $this->hasOne(Customer::className(), ['id_customer' => 'id_customer']);
    }
     public function getlogin()
    {
        return $this->hasOne(Login::className(), ['id_login' => 'id_login']);
    }
}
