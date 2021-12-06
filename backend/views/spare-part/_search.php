<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spare-part-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_spare_part') ?>

    <?= $form->field($model, 'tanggal_masuk') ?>

    <?= $form->field($model, 'tanggal_jatuh_tempo') ?>

    <?= $form->field($model, 'id_nama_spare_part') ?>

    <?= $form->field($model, 'id_merk') ?>

    <?= $form->field($model, 'jns_pembayaran') ?>

    <?php // echo $form->field($model, 'id_rak') ?>

    <?php echo $form->field($model, 'id_supplier') ?>

    <?php // echo $form->field($model, 'id_uom') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'harga_beli') ?>

    <?php // echo $form->field($model, 'harga_jual') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
