<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceDetail */

$this->title = 'Create Penjualan Spare Part Detail';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_spare_part_stok' => $array_spare_part_stok,
            'selected_array_spare_part_stok' => $selected_array_spare_part_stok,
        
    ]) ?>

</div>
