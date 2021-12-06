<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_karyawan') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tanggal_lahir') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'jenis_kelamain') ?>

    <?php // echo $form->field($model, 'pendidikan_terakhir') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'status_karywan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
