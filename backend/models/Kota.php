<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kota".
 *
 * @property int $id
 * @property string $kota
 */
class Kota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kota'], 'required'],
            [['kota'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kota' => 'Kota',
        ];
    }
}
