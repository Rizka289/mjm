<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartStok */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spare-part-stok-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_nama_spare_part')->textInput() ?>

    <?= $form->field($model, 'stok')->textInput() ?>

    <?= $form->field($model, 'id_spare_part')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
