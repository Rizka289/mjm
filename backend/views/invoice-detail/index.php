<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InvoiceDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Invoice Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_invoice_detail',
            'id_invoice',
            'id_spare_part_stok',
            'jumlah_transaksi',
            'diskon',
            //'diskon_persen',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
