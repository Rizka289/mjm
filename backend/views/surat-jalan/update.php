<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratJalan */

$this->title = 'Update Surat Jalan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Jalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-jalan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'array_kota' => $array_kota,
            'selected_kota' => $selected_kota,
            'array_unit' => $array_unit,
            'selected_unit' => $selected_unit,
            'array_karyawan' => $array_karyawan,
            'selected_karyawan' => $selected_karyawan,
    ]) ?>

</div>
