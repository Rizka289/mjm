<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SuratDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Surat Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_surat_jalan',
            'id_spare_part_stok',
            'jumlah_transaksi',
            'harga_jual',
            //'diskon',
            //'diskon_persen',
            //'setelah_diskon',
            //'nama_spare_part',
            //'no_seri',
            //'merk_spare_part',
            //'id_login',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
