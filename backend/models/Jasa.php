<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jasa".
 *
 * @property int $id_jasa
 * @property string $nama_jasa
 * @property string $tipe
 * @property int $id_merk
 * @property string $alamat
 * @property int $harga
 * @property int $jumlah
 */
class Jasa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jasa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_jasa', 'tipe', 'id_merk', 'alamat', 'harga', 'jumlah'], 'required'],
            [['id_merk', 'harga', 'jumlah'], 'integer'],
            [['nama_jasa', 'tipe', 'alamat'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jasa' => 'Id Jasa',
            'nama_jasa' => 'Nama Jasa',
            'tipe' => 'Tipe',
            'id_merk' => 'Id Merk',
            'alamat' => 'Alamat',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
        ];
    }
}
