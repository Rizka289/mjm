<?php

namespace backend\models;

use Yii;


class MerkSparePart extends \yii\db\ActiveRecord
{
   
    public static function tableName()
    {
        return 'merk_spare_part';
    }

  
    public function rules()
    {
        return [
            [['nama_merk'], 'required'],
            [['nama_merk'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_merk' => 'Id Merk',
            'nama_merk' => 'Nama Merk',
        ];
    }
}
