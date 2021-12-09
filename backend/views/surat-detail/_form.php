<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SuratDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_surat_jalan')->textInput() ?>

    <?= $form->field($model, 'id_spare_part_stok')->textInput() ?>

    <?= $form->field($model, 'jumlah_transaksi')->textInput() ?>

    <?= $form->field($model, 'harga_jual')->textInput() ?>

    <?= $form->field($model, 'diskon')->textInput() ?>

    <?= $form->field($model, 'diskon_persen')->textInput() ?>

    <?= $form->field($model, 'setelah_diskon')->textInput() ?>

    <?= $form->field($model, 'nama_spare_part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_seri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merk_spare_part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_login')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
