<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spare-part-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_spare_part_detail') ?>

    <?= $form->field($model, 'id_nama_spare_part') ?>

    <?= $form->field($model, 'id_merk_spare_part') ?>

    <?= $form->field($model, 'id_spare_part') ?>

    <?= $form->field($model, 'harga_beli') ?>

    <?php // echo $form->field($model, 'harga_jual') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
