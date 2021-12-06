<?php

namespace backend\models;

use Yii;


class NamaSparePart extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'nama_spare_part';
    }

    public function rules()
    {
        return [
            [['nama_spare_part','no_seri','stok_minimal'], 'required'],
            [['nama_spare_part','nama_rak'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_nama_spare_part' => 'Id Nama Spare Part',
            'nama_spare_part' => 'Nama Spare Part',
            'no_seri' => 'Nomor Seri / Type',
            'stok_minimal' => 'Stok Minimal',
            'nama_rak' => 'Lokasi rak',
        ];
    }
}
