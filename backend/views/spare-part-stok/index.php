<?php

use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'Spare Part Stok';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-stok-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => "No",
                'headerOptions'=> ['style'=>'color:#337ab7']],
            'nama_spare_part',
            'no_seri',
            'merk_spare_part',
            'stok',
            'nama_rak',
            'harga',
            // 'nama_spare_part.stok_minimal',
            [
                'label' => 'Stok Minimal',
                'format' => 'raw',
                'filter'    => array(
                    0 => "Stok Habis",
                    1 => "Stok Menipis",
                    2 => "Stok Banyak",
                ),
                'value' => function ($model) {
                    $stok_min = Yii::$app->db->createCommand("SELECT stok_minimal FROM nama_spare_part LEFT JOIN spare_part_stok ON spare_part_stok.nama_spare_part = nama_spare_part.nama_spare_part WHERE nama_spare_part.no_seri = '$model->no_seri' and nama_spare_part.nama_rak = '$model->nama_rak'")->queryScalar();
                    if ($model->stok == 0) {
                        return "<span class='label label-danger' style='font-size: 90%'>Stok Habis</span>";
                    } else if ($model->stok <= $stok_min) {
                        return  "<span class='label label-warning' style='font-size: 90%'>Stok Menipis</span>";
                    } else if ($stok_min == null) {
                        return "<span class='label label-primary' style='font-size: 90%'>Data Minimal Belom Disetting</span>";
                    } else {
                        return  "<span class='label label-success' style='font-size: 90%'>Stok Banyak</span>";
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
                'filename' => 'Data_SuratJalan',
                'showPageSummary' => true,
            ]
         ],
    ]); ?>
</div>

