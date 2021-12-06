<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvoiceDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_invoice_detail') ?>

    <?= $form->field($model, 'id_invoice') ?>

    <?= $form->field($model, 'id_spare_part_stok') ?>

    <?= $form->field($model, 'jumlah_transaksi') ?>

    <?= $form->field($model, 'diskon') ?>

    <?php // echo $form->field($model, 'diskon_persen') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
