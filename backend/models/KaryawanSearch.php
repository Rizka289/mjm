<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Karyawan;


class KaryawanSearch extends Karyawan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_karyawan','jenis_kelamin', 'pendidikan_terakhir', 'agama', 'status_karyawan'], 'integer'],
            [['nama', 'tanggal_lahir', 'alamat','tanggal_masuk','tanggal_keluar','tempat_lahir','nik'], 'safe'],
        ];
    }

   
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

   
    public function search($params)
    {
        $query = Karyawan::find()->orderBy('id_karyawan DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_karyawan' => $this->id_karyawan,
            // 'nik' => $this->nik,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'agama' => $this->agama,
            'status_karyawan' => $this->status_karyawan,
            
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'nik', $this->nik]);

        return $dataProvider;
    }
}
