<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuNavigasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Navigasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-navigasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menu Navigasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

 

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_menu',
            'url',
            
            'no_urut',
            'icon',
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'filter'    => array(0=>"Aktif", 1=>"Tidak Aktif"),
                'value'     => function ($model)
                {
                    return $model->status == 0 ? "<span class='label label-success'>Aktif</span>" : "<span class='label label-warning'>Tidak Aktif</span>";
                }
            ],


			
            ['class' => 'yii\grid\ActionColumn'],
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
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        // parameters from the demo form
        //'bordered' => $bordered,
        //'striped' => $striped,
        //'condensed' => $condensed,
        //'responsive' => $responsive,
        //'hover' => $hover,
        //'showPageSummary' => $pageSummary,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 100],
        'exportConfig' => [
            GridView::EXCEL =>  [
                'filename' => 'Data_Menu_Navigasi',
                'showPageSummary' => true,
            ]

        ],
        //'itemLabelSingle' => 'book',
        //'itemLabelPlural' => 'books'
    ]); ?>
</div>
