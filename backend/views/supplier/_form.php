<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="supplier-form">
<div class="box">
<div class="box-header">
<div class="col-md-6" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_supplier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_hp')->textInput() ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
