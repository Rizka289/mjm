<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceDetail */

$this->title = 'Update Invoice Detail: ' . $model->spare_part_stok->nama_spare_part;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_invoice_detail, 'url' => ['view', 'id' => $model->id_invoice_detail]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_spare_part_stok' => $array_spare_part_stok,
        'selected_array_spare_part_stok' => $selected_array_spare_part_stok,
    ]) ?>

</div>
