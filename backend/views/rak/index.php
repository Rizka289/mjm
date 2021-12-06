<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Data Rak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Rak', ['create'], ['class' => 'btn btn-success']) ?>
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
            'nama_rak',

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

