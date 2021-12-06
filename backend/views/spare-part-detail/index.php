<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SparePartDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Spare Part Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Spare Part Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_spare_part_detail',
            'id_nama_spare_part',
            'id_merk_spare_part',
            'id_spare_part',
            'harga_beli',
            //'harga_jual',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
