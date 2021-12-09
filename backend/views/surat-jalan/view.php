<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Unit;
use backend\models\Karyawan;
use backend\models\Login;

$this->title = $model->tanggal_pengiriman;
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surat-jalan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Tambah Spare Part', ['surat-detail/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
<div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'tanggal_pengiriman',
            [
                'attribute' => 'id_karyawan',
                'label' => 'Nama Driver',
                'value' => function ($model)  {
                    $submitter = Karyawan::find()->where(["id_karyawan"=>$model->id_karyawan])->one();
                    if ($submitter != null){
                        return $submitter->nama;
                    } else {
                        return "Data Driver Sudah Hapus";
                    }
                }
            ],
            [
                'attribute' => 'id_unit',
                'label' => 'Nopol',
                'value' => function ($model)  {
                    $submitter = Unit::find()->where(["id_unit"=>$model->id_unit])->one();
                    if ($submitter != null){
                        return $submitter->nopol;
                    } else {
                        return "Data Unit Sudah Hapus";
                    }
                }
            ],
            'tujuan',
            'kota.kota',
             [
                'attribute' => 'status',
                'filter'    => array(
                    1 => "Completed",
                    2 => "On Progress"
                ),
                'value'     => function ($model)
                {
                    if ($model->status == 1) {
                        return "Completed";
                    } else {
                        return "On Progress";
                    }
                }
             ],
            'keterangan:ntext',
            [
				'attribute' 	=> 'Dibuat Oleh',
				'format'			=> 'html',
			    'value'			=> function ($model) 
				{
					$submitter = Login::find()->where(["id_login"=>$model->id_login])->one();
					if ($submitter != null){
						return $submitter->nama;
					} else {
						"";
					}
				}
			],
        ],
    ]) ?>

</div>
