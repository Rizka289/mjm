<?php

namespace backend\models;

use Yii;

class SparePartStok extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'spare_part_stok';
    }

    public function rules()
    {
        return [
            [['stok'], 'required'],
            [['stok','harga'], 'integer'],
            [['stok','nama_spare_part','merk_spare_part','no_seri','id_spare_part_detail','nama_rak'], 'string'],
        ];
    }

  
    public function attributeLabels()
    {
        return [
            'id_spare_part_stok' => 'Id Spare Part Stok',
            'nama_spare_part' => 'Nama Spare Part',
            'merk_spare_part' => 'Merk Spare Part',
            'no_seri' => 'Nomor Seri / Type',
            'stok' => 'Stok',
            'id_spare_part_detail' => 'Id Spare Part Detail',
            'harga' => 'Harga Jual',
            'nama_rak' => 'Lokasi Rak',
        ];
    }

}
