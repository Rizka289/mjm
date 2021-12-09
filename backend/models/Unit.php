<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id_unit
 * @property string $nopol
 * @property string $merk_unit
 * @property string $pemilik_unit
 * @property string $warna_unit
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nopol', 'merk_unit', 'pemilik_unit', 'warna_unit'], 'required'],
            [['nopol', 'merk_unit', 'warna_unit'], 'string', 'max' => 50],
            [['pemilik_unit'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_unit' => 'Id Unit',
            'nopol' => 'Nopol',
            'merk_unit' => 'Merk Unit',
            'pemilik_unit' => 'Pemilik Unit',
            'warna_unit' => 'Warna Unit',
        ];
    }
}
