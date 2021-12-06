<?php

use yii\helpers\Html;



$this->title = 'Tambah Transaksi Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_customer' => $array_customer,
        'selected_customer' => $selected_customer,
    ]) ?>

</div>
