<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratJalanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-jalan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_kota') ?>

    <?= $form->field($model, 'id_unit') ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <?= $form->field($model, 'id_login') ?>

    <?php // echo $form->field($model, 'tanggal_pengiriman') ?>

    <?php // echo $form->field($model, 'tujuan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
