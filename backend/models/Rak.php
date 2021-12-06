<?php

namespace backend\models;

use Yii;

class Rak extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'rak';
    }

    public function rules()
    {
        return [
            [['nama_rak'], 'required'],
            [['nama_rak'], 'string', 'max' => 100],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id_rak' => 'Id Rak',
            'nama_rak' => 'Nama Rak',
        ];
    }
}
