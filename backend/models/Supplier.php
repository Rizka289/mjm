<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id_supplier
 * @property string $nama_supplier
 * @property string $alamat
 * @property int $no_hp
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_supplier', 'alamat', 'no_hp'], 'required'],
            [['no_hp'], 'integer'],
            [['nama_supplier', 'alamat'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_supplier' => 'Id Supplier',
            'nama_supplier' => 'Nama Supplier',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
        ];
    }
}
