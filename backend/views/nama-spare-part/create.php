<?php

use yii\helpers\Html;


$this->title = 'Tambah Nama Barang';
$this->params['breadcrumbs'][] = ['label' => 'Nama Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nama-barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_rak' => $array_rak,
        'selected_rak' => $selected_rak,
    ]) ?>

</div>
