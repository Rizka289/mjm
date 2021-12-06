<?php

namespace backend\models;

use Yii;


class Uom extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'uom';
    }


    public function rules()
    {
        return [
            [['uom'], 'required'],
            [['uom'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_uom' => 'Id Uom',
            'uom' => 'Satuan',
        ];
    }
}
