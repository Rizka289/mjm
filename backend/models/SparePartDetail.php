<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spare_part_detail".
 *
 * @property int $id_spare_part_detail
 * @property int $id_nama_spare_part
 * @property int $id_merk_spare_part
 * @property int $id_spare_part
 * @property int $harga_beli
 * @property int $harga_jual
 */
class SparePartDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spare_part_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nama_spare_part', 'id_merk_spare_part', 'id_spare_part', 'harga_beli', 'harga_jual','jumlah'], 'required'],
            [['id_nama_spare_part', 'id_merk_spare_part', 'id_spare_part', 'status_stok'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_spare_part_detail' => 'Id Spare Part Detail',
            'id_nama_spare_part' => 'Nama Spare Part',
            'id_merk_spare_part' => 'Merk Spare Part',
            'id_spare_part' => 'Id Spare Part',
            'harga_beli' => 'Harga Beli',
            'harga_jual' => 'Harga Jual',
            'jumlah' => 'Jumlah',
        ];
    }
      public function getnama_spare_part()
    {
        return $this->hasOne(NamaSparePart::className(), ['id_nama_spare_part' => 'id_nama_spare_part']);
    }
      public function getmerk_spare_part()
    {
        return $this->hasOne(MerkSparePart::className(), ['id_merk' => 'id_merk_spare_part']);
    }
}
