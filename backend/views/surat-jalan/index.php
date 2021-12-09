<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;



$this->title = 'Surat Jalans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-jalan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Surat Jalan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => "No",
                'headerOptions'=> ['style'=>'color:#337ab7']],
            ['class' => 'yii\grid\ActionColumn',
                'header'=> 'Actions',
                'headerOptions'=>['style'=>'color:#337ab7']],


            // 'id',
            'tanggal_pengiriman',
           [
                'attribute' => 'id_karyawan',
                'label' => 'Nama Driver',
                'value' => function ($model)  {
                      if (!empty($model->karyawan)) {
                        return $model->karyawan->nama;
                    } else {
                        return "Data Driver Sudah Hapus";
                    }
                }
            ],
            [
                'attribute' => 'id_unit',
                'label' => 'Nopol',
                'value' => function ($model)  {
                     if (!empty($model->unit)) {
                        return $model->unit->nopol;
                    } else {
                        return "Data Supplier Sudah Hapus";
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

            ['class' => 'yii\grid\ActionColumn'],
        ],   'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            //'pjax' => true, // pjax is set to always true for this demo
            // set your toolbar
            'toolbar' =>  [
                
                '{export}',
                '{toggleData}',
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'export' => [
                'fontAwesome' => true
            ],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => '',
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 100],
            'exportConfig' => [
                GridView::EXCEL =>  [
                    'filename' => 'Data_Surat_Jalan',
                    'showPageSummary' => true,
                ]

            ],
        ]); ?>
    </div>
