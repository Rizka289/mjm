<?php

use yii\helpers\Html;



$this->title = 'Update Merk: ' . $model->nama_merk;
$this->params['breadcrumbs'][] = ['label' => 'Merks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_merk, 'url' => ['view', 'id' => $model->id_merk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="merk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
