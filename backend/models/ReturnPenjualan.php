<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "return_penjualan".
 *
 * @property int $id_return
 * @property int $id_invoice
 * @property string $nama_spare_part
 * @property string $no_seri
 * @property string $merk_spare_part
 * @property int $jumlah
 * @property int $harga
 * @property string $keterangan_return
 */
class ReturnPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'return_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_invoice', 'nama_spare_part', 'no_seri', 'merk_spare_part', 'jumlah', 'harga', 'keterangan_return'], 'required'],
            [['id_invoice', 'jumlah', 'harga'], 'integer'],
            [['nama_spare_part', 'no_seri', 'merk_spare_part'], 'string', 'max' => 255],
            [['keterangan_return'], 'string', 'max' => 500],
            [['foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_return' => 'Id Return',
            'id_invoice' => 'Id Invoice',
            'nama_spare_part' => 'Nama Spare Part',
            'no_seri' => 'No Seri',
            'merk_spare_part' => 'Merk Spare Part',
            'jumlah' => 'Jumlah',
            'harga' => 'Setelah Diskon',
            'keterangan_return' => 'Keterangan Return',
        ];
    }
      public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
			if ($this->foto)
			{
				$filename = time()."_". str_replace(" ","_",$this->foto->baseName) . '.' . $this->foto->extension;
				$this->foto->saveAs('upload/' .$filename);
				$this->foto = $filename;
            }
			else
			{
				if (Yii::$app->request->get('id'))
				{
				$foto = Login::findOne(Yii::$app->request->get('id'));
				$this->foto = $foto->foto;
				}
				else
				{
					$this->foto = "avatar5.png";
				}
			}
            return true;
        }
        
    }
}
