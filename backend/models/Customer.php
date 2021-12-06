<?php

namespace backend\models;

use Yii;


class Customer extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'customer';
    }

   
    public function rules()
    {
        return [
            [['nama_customer', 'alamat', 'no_telp'], 'required'],
            [['nama_customer'], 'string', 'max' => 100],
            [['alamat','kota'], 'string', 'max' => 250],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'nama_customer' => 'Nama Customer',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'kota' => 'Kota',
        ];
    }
}
