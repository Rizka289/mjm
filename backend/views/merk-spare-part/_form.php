<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="merk-form">
<div class="box">
<div class="box-header">
<div class="col-md-6" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_merk')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
