<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_detail".
 *
 * @property int $id_invoice_detail
 * @property int $id_invoice
 * @property int $id_spare_part_stok
 * @property int $jumlah_transaksi
 * @property int $diskon
 * @property double $diskon_persen
 */
class InvoiceDetail extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'invoice_detail';
    }

   
    public function rules()
    {
        return [
            [['id_invoice', 'id_spare_part_stok', 'jumlah_transaksi'], 'required'],
            [['id_invoice', 'id_spare_part_stok', 'jumlah_transaksi', 'diskon','diskon_persen','setelah_diskon','id_login'], 'integer'],
            [['no_seri','nama_spare_part','merk_spare_part'], 'string'],
         
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'id_invoice_detail' => 'Id Invoice Detail',
            'id_invoice' => 'Id Invoice',
            'id_spare_part_stok' => 'Nama Spare Part Stok',
            'jumlah_transaksi' => 'Jumlah',
            'diskon' => 'Diskon (Harga)',
            'id_login' => 'Dibuat Oleh',
            'diskon_persen' => 'Diskon (Persen)',
            'setelah_diskon' => 'Setelah Diskon',
            'no_seri' => 'No. Seri',
            'nama_spare_part' => 'Nama Spare Part',
            'merk_spare_part' => 'Merk Spare Part',
        ];
    }
     public function getlogin()
    {
        return $this->hasOne(Login::className(), ['id_login' => 'id_login']);
    }
     public function getspare_part_stok()
    {
        return $this->hasOne(SparePartStok::className(), ['id_spare_part_stok' => 'id_spare_part_stok']);
    }

    
}
