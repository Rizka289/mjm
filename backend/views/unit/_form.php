<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="unit-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">
   

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nopol')->textInput() ?>
    <?= $form->field($model, 'merk_unit')->textInput() ?>
    <?= $form->field($model, 'pemilik_unit')->textInput() ?>
    <?= $form->field($model, 'warna_unit')->textInput() ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

