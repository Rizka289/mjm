<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "surat_detail".
 *
 * @property int $id
 * @property int $id_surat_jalan
 * @property int $id_spare_part_stok
 * @property int $jumlah_transaksi
 * @property int $harga_jual
 * @property int $diskon
 * @property int $diskon_persen
 * @property int $setelah_diskon
 * @property string $nama_spare_part
 * @property string $no_seri
 * @property string $merk_spare_part
 * @property int $id_login
 */
class SuratDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_surat_jalan', 'id_spare_part_stok', 'jumlah_transaksi', 'harga_jual', 'diskon', 'diskon_persen', 'setelah_diskon', 'nama_spare_part', 'no_seri', 'merk_spare_part', 'id_login'], 'required'],
            [['id_surat_jalan', 'id_spare_part_stok', 'jumlah_transaksi', 'harga_jual', 'diskon', 'diskon_persen', 'setelah_diskon', 'id_login'], 'integer'],
            [['nama_spare_part', 'no_seri', 'merk_spare_part'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_surat_jalan' => 'Id Surat Jalan',
            'id_spare_part_stok' => 'Id Spare Part Stok',
            'jumlah_transaksi' => 'Jumlah Transaksi',
            'harga_jual' => 'Harga Jual',
            'diskon' => 'Diskon',
            'diskon_persen' => 'Diskon Persen',
            'setelah_diskon' => 'Setelah Diskon',
            'nama_spare_part' => 'Nama Spare Part',
            'no_seri' => 'No Seri',
            'merk_spare_part' => 'Merk Spare Part',
            'id_login' => 'Id Login',
        ];
    }
}
