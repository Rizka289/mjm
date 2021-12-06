<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuNavigasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-navigasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_menu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_parent')->dropDownlist($menuParent, ['prompt'=>'Pilih Parent Menu']) ?>

    <?php 
    if (!$model->isNewRecord)
    {
        echo $form->field($model, 'no_urut')->textInput();
    }
    ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownlist(array(0=>"Aktif", 1=>"Tidak Aktif")) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
