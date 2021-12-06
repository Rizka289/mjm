<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\NamaBarang */

$this->title = 'Update Nama Barang: ' . $model->id_nama_spare_part;
$this->params['breadcrumbs'][] = ['label' => 'Nama Spare Part', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_nama_spare_part, 'url' => ['view', 'id' => $model->id_nama_spare_part]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nama-barang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'array_rak' => $array_rak,
        'selected_rak' => $selected_rak,
    ]) ?>

</div>
