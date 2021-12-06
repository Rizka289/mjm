<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use backend\models\Invoice;



$this->title = 'Transaksi Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Penjualan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;white-space: nowrap;">Jumlah Belanja</th>
                <td>:
                    <?php
                    $totalanJumlahBelanja = 0;
                    $queryInvoice = Invoice::find()->all();
                    foreach ($queryInvoice as $key => $data) {
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
                    $queryInvoice = Invoice::find()->all();
                    foreach ($queryInvoice as $key => $data) {
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
                    $queryInvoice = Invoice::find()->all();
                    foreach ($queryInvoice as $key => $data) {
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
            ['class' => 'yii\grid\ActionColumn',
                'header'=> 'Actions',
                'headerOptions'=>['style'=>'color:#337ab7']],

            // 'id_invoice',    
            [
                'attribute' => 'id_customer',
                'label' => 'Nama Customer ',
                'value' => function ($model) {
                    if (!empty($model->customer)) {
                        return $model->customer->nama_customer;
                    } else {
                        return "Data Supplier Sudah Hapus";
                    }
                }
            ],
             [
                'attribute' => 'tanggal_transaksi',
                'value' => function ($model) {
                    if (!empty($model->tanggal_transaksi)) {
                        # code...
                        return Yii::$app->formatter->asDate($model->tanggal_transaksi, 'php:d F Y');
                    }
                },
                'filter' => DateRangePicker::widget([

                    'model' => $searchModel,

                    'attribute' => 'tanggal_transaksi',

                    'convertFormat' => true,

                    'pluginOptions' => [

                        'locale' => [

                            'format' => 'Y-m-d'

                        ],

                    ],

                ]),
            ],
           
            [
                'attribute' => 'tanggal_tagihan',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!empty( $model->tanggal_tagihan)) {
                        return Yii::$app->formatter->asDate($model->tanggal_tagihan, 'php:d F Y');
                    }else {
                        return Yii::$app->formatter->asDate($model->tanggal_tagihan, 'php:d F Y') ;
                    }
                },
                'filter' => DateRangePicker::widget([

                    'model' => $searchModel,

                    'attribute' => 'tanggal_tagihan',

                    'convertFormat' => true,

                    'pluginOptions' => [

                        'locale' => [

                            'format' => 'Y-m-d'

                        ],

                    ],

                ]),
            ],
            // 'tanggal_transaksi',
            'keterangan:ntext',
            //'status',
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
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
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
                    'filename' => 'Data_Customer',
                    'showPageSummary' => true,
                ]

            ],
        ]); ?>
    </div>

