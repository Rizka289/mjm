<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Jasa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jasa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_jasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_merk')->textInput() ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
