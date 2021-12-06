<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spare_part".
 *
 * @property int $id_spare_part
 * @property string $tanggal_masuk
 * @property string $tanggal_jatuh_tempo
 * @property int $id_nama_spare_part
 * @property int $id_merk
 * @property int $id_rak
 * @property int $id_supplier
 * @property int $id_uom
 * @property int $jumlah
 * @property int $harga_beli
 * @property int $harga_jual
 */
class SparePart extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'spare_part';
    }

 
    public function rules()
    {
        return [
            [['tanggal_masuk', 'tanggal_jatuh_tempo', 'id_supplier','jumlah_belanja'], 'required'],
            [['tanggal_masuk', 'tanggal_jatuh_tempo','no_nota_supplier','no_nota_masuk','dp','sisa_pembayaran', 'jumlah_belanja','status_tempo'], 'safe'],
            [['id_supplier','jns_pembayaran','id_login'], 'integer'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id_spare_part' => 'Id Spare Part',
            'tanggal_masuk' => 'Tanggal Masuk',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo Pembayaran',
            'jumlah_belanja' => 'Jumlah_belanja',
            'jns_pembayaran' => 'Jenis Pembayaran',
            'no_nota_masuk' => 'No. Nota Masuk',
            'id_login' => 'Dibuat Oleh',
            'id_supplier' => 'Nama Supplier',
            'no_nota_supplier' => 'No. Nota Supplier',
            'dp' => 'Dp / Jumlah Yang Sudah Dibayar',
            'sisa_pembayaran' => 'Sisa Pembayaran',
        ];
    }
    public function getsupplier()
    {
        return $this->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
    }
      public function getlogin()
    {
        return $this->hasOne(Login::className(), ['id_login' => 'id_login']);
    }
    
}
