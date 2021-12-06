<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use backend\models\SparePart;



$this->title = 'Data Spare Part Masuk / Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Spare Part', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
            <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;white-space: nowrap;">Jumlah Belanja</th>
                <td>:
                    <?php
                    $totalanJumlahBelanja = 0;
                    $querySparePart = SparePart::find()->all();
                    foreach ($querySparePart as $key => $data) {
                        # code...
                        $totalanJumlahBelanja += $data->jumlah_belanja;
                    }
                    echo 'Rp. ' . number_format($totalanJumlahBelanja, 2, ',', '.') . '';
                   
                    ?>
                </td>
            </tr>
            <tr>
                <th style="width: 5%;white-space: nowrap;">Status Yang Sudah Bayar</th>
                <td>:
                    <?php
                    $totalanJumlahPembayaran = 0;
                    $querySparePart = SparePart::find()->all();
                    foreach ($querySparePart as $key => $data) {
                        # code...
                        $totalanJumlahPembayaran += $data->dp;
                    }
                    echo 'Rp. ' . number_format($totalanJumlahPembayaran, 2, ',', '.');
                    ?>
                </td>
            </tr>
            <tr>
                <th style="width: 5%;white-space: nowrap;">Status Yang Belum Bayar</th>
                <td>:
                    <?php
                    $totalanJumlahPembayarann = 0;
                    $querySparePart = SparePart::find()->all();
                    foreach ($querySparePart as $key => $data) {
                        # code...
                        $totalanJumlahPembayarann += $data->sisa_pembayaran;
                    }
                    echo 'Rp. ' . number_format($totalanJumlahPembayarann, 2, ',', '.');
                   
                    ?>
                </td>
            </tr>
            </tr>
        </thead>
    </table>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => "No",
                'headerOptions'=> ['style'=>'color:#337ab7']],
           [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => "{view}",
                'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'lead-update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'lead-delete'),
                        'data' => [
                            'confirm' => 'Anda yakin ingin menghapus data?',
                        ],
                    ]);
                },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=spare-part/view&id='.$model->id_spare_part;
                        return $url;
                    }

                    // if ($action === 'update') {
                    //     $url ='index.php?r=workshop/update&id='.$model->id_workshop;
                    // return $url;
                    // }

                    // if ($action === 'delete') {
                    //     $url ='index.php?r=workshop/delete&id='.$model->id_workshop;
                    //     return $url;
                    // }
                }
            ],
            'no_nota_masuk',
            [
                'attribute' => 'tanggal_masuk',
                'value' => function ($model) {
                    if (!empty($model->tanggal_masuk)) {
                        # code...
                        return Yii::$app->formatter->asDate($model->tanggal_masuk, 'php:d F Y');
                    }
                },
                'filter' => DateRangePicker::widget([

                    'model' => $searchModel,

                    'attribute' => 'tanggal_masuk',

                    'convertFormat' => true,

                    'pluginOptions' => [

                        'locale' => [

                            'format' => 'Y-m-d'

                        ],

                    ],

                ]),
            ],
           
            [
                'attribute' => 'id_supplier',
                'label' => 'Nama Supplier ',
                'value' => function ($model) {
                    if (!empty($model->supplier)) {
                        return $model->supplier->nama_supplier;
                    } else {
                        return "Data Supplier Sudah Hapus";
                    }
                }
            ],
            [
                'attribute' => 'tanggal_jatuh_tempo',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!empty( $model->tanggal_jatuh_tempo)) {
                        return Yii::$app->formatter->asDate($model->tanggal_jatuh_tempo, 'php:d F Y');
                    }else {
                        return Yii::$app->formatter->asDate($model->tanggal_jatuh_tempo, 'php:d F Y') ;
                    }
                },
                'filter' => DateRangePicker::widget([

                    'model' => $searchModel,

                    'attribute' => 'tanggal_jatuh_tempo',

                    'convertFormat' => true,

                    'pluginOptions' => [

                        'locale' => [

                            'format' => 'Y-m-d'

                        ],

                    ],

                ]),
            ],
            'jumlah_belanja',
              [
                'attribute' => 'jns_pembayaran',
                'filter' => array(
                    0 => "-",
                    1 => "Cash",
                    2 => "Credit",
                ),
                'value'     => function ($model)
                {
                    if ($model->jns_pembayaran == 1) {
                        return "Cash";
                    } elseif ($model->jns_pembayaran == 2) {
                        return "Credit";
                    }else {
                        return "-";
                    }
                }
            ],
               [
                'attribute' => 'status_tempo',
                'label' => 'Status Jatuh Tempo',
                'format' => 'raw',
                'filter'    => array(
                    1 => "Tidak Jatuh Tempo (Transaksi Selesai)",
                    2 => "Belum Jatuh Tempo",
                    3 => "Sudah Jatuh Tempo",
                ),
                'value'     => function ($model)
                {
                    if ($model->status_tempo == 1) {
                        return  "<span class='label label-success' style='font-size: 90%'>Tidak Jatuh Tempo (Transaksi Selesai)</span>";
                    } else if ($model->status_tempo === 2) {
                        return  "<span class='label label-warning' style='font-size: 90%'>Belum Jatuh Tempo</span>";
                    }else {
                        return "<span class='label label-danger' style='font-size: 90%'>Sudah Jatuh Tempo</span>";
                    }
                }
            ],
             ],
            'containerOptions' => ['style' => 'overflow: auto'],
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
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
            'autoXlFormat' => true,
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'export' => [
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK
            ],
            'exportConfig' => [
            GridView::EXCEL =>  [
                'filename' => 'Data_SparePart',
                'showPageSummary' => true,
            ]
         ],
    ]); ?>
</div>

