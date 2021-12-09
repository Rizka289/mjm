<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_surat_jalan') ?>

    <?= $form->field($model, 'id_spare_part_stok') ?>

    <?= $form->field($model, 'jumlah_transaksi') ?>

    <?= $form->field($model, 'harga_jual') ?>

    <?php // echo $form->field($model, 'diskon') ?>

    <?php // echo $form->field($model, 'diskon_persen') ?>

    <?php // echo $form->field($model, 'setelah_diskon') ?>

    <?php // echo $form->field($model, 'nama_spare_part') ?>

    <?php // echo $form->field($model, 'no_seri') ?>

    <?php // echo $form->field($model, 'merk_spare_part') ?>

    <?php // echo $form->field($model, 'id_login') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
