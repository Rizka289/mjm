<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "surat_jalan".
 *
 * @property int $id
 * @property int $id_kota
 * @property int $id_unit
 * @property int $id_karyawan
 * @property int $id_login
 * @property string $tanggal_pengiriman
 * @property int $tujuan
 * @property int $status
 * @property string $keterangan
 */
class SuratJalan extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'surat_jalan';
    }

   
    public function rules()
    {
        return [
            [['id_kota', 'id_unit', 'id_karyawan', 'id_login', 'tanggal_pengiriman', 'tujuan', 'status', 'keterangan'], 'required'],
            [['id_kota', 'id_unit', 'id_karyawan', 'id_login','status'], 'integer'],
            [['tanggal_pengiriman'], 'safe'],
            [['keterangan'], 'string'],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kota' => 'Kota',
            'id_unit' => 'Nopol',
            'id_karyawan' => 'Nama Driver',
            'id_login' => 'Id Login',
            'tanggal_pengiriman' => 'Tanggal Pengiriman',
            'tujuan' => 'Tujuan',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
        ];
    }
     public function getkota()
    {
        return $this->hasOne(Kota::className(), ['id' => 'id_kota']);
    }
     public function getunit()
    {
        return $this->hasOne(Unit::className(), ['id_unit' => 'id_unit']);
    }
     public function getkaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id_karyawan' => 'id_karyawan']);
    }
       public function getlogin()
    {
        return $this->hasOne(Login::className(), ['id_login' => 'id_login']);
    }   
}
