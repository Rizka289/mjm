<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



$this->title = $model->nama_spare_part;
$this->params['breadcrumbs'][] = ['label' => 'Nama Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nama-barang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_nama_spare_part], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_nama_spare_part], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_nama_spare_part',
            'nama_spare_part',
            'nama_rak',
            'no_seri',
            'stok_minimal',
        ],
    ]) ?>

</div>
