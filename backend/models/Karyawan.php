<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "karyawan".
 *
 * @property int $id_karyawan
 * @property int $nik
 * @property string $nama
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property int $jenis_kelamain
 * @property int $pendidikan_terakhir
 * @property int $agama
 * @property int $status_karywan
 */
class Karyawan extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'karyawan';
    }

    
    public function rules()
    {
        return [
            [['nik', 'nama', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'pendidikan_terakhir', 'agama', 'status_karyawan'], 'required'],
            [['jenis_kelamin', 'pendidikan_terakhir', 'agama', 'status_karyawan'], 'integer'],
            [['tanggal_lahir','tanggal_masuk','tanggal_keluar','nik'], 'safe'],
            [['nama', 'alamat','tempat_lahir'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_karyawan' => 'Id Karyawan',
            'nik' => 'Nik',
            'nama' => 'Nama',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'jenis_kelamin' => 'Jenis Kelamain',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
            'agama' => 'Agama',
            'status_karyawan' => 'Status Karyawan',
            'tanggal_masuk' => 'Tanggal Masuk',
            'tanggal_keluar' => 'Tanggal Keluar',
            'tempat_lahir' => 'Tempat Lahir',
        ];
    }
}
