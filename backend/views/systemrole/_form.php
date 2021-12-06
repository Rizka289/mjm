<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Systemrole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box">
    <div class="box-header">
    <div class="col-md-12" style="padding: 0;">
    <div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_role')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
