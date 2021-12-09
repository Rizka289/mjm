<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surat-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_surat_jalan',
            'id_spare_part_stok',
            'jumlah_transaksi',
            'harga_jual',
            'diskon',
            'diskon_persen',
            'setelah_diskon',
            'nama_spare_part',
            'no_seri',
            'merk_spare_part',
            'id_login',
        ],
    ]) ?>

</div>
