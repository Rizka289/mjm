<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartDetail */

$this->title = 'Update Spare Part Detail: ' . $model->id_spare_part_detail;
$this->params['breadcrumbs'][] = ['label' => 'Spare Part Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_spare_part_detail, 'url' => ['view', 'id' => $model->id_spare_part_detail]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spare-part-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'array_nama_spare_part' => $array_nama_spare_part,
            'array_merk_spare_part' => $array_merk_spare_part,
            'selected_nama_spare_part' => $selected_nama_spare_part,
            'selected_merk_spare_part' => $selected_merk_spare_part,
    ]) ?>

</div>
