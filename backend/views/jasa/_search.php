<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JasaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jasa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_jasa') ?>

    <?= $form->field($model, 'nama_jasa') ?>

    <?= $form->field($model, 'tipe') ?>

    <?= $form->field($model, 'id_merk') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'harga') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
