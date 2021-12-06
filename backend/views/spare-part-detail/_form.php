<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use backend\models\NamaSparePart;
use backend\models\MerkSparePart;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
 
?>

<div class="spare-part-detail-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
    <?php 
   
    ?>

    <?= $form->field($model, 'id_spare_part')->textInput(['readonly' => true,'value' => $_GET['id'], 'type' => 'hidden'])->label(false) ?>
  
   <?php
        $the_nama_spare_part = "";
            if ($selected_nama_spare_part != "") {
                $the_nama_spare_part = $selected_nama_spare_part->nama_spare_part;
            }

            echo '<label class="control-label" for="spare-part-detail-nama">Nama Spare Part</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_nama_spare_part,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#sparepartdetail-id_nama_spare_part').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SparePartDetail[id_nama_spare_part]',
            'value' => $the_nama_spare_part,
        ]);
        echo $form->field($model, 'id_nama_spare_part')
         ->textInput(["value" => $model->id_nama_spare_part, "readonly" => true])
         ->label(false);
    ?>
   <?php
        $the_merk_spare_part = "";
            if ($selected_merk_spare_part != "") {
                $the_merk_spare_part = $selected_merk_spare_part->nama_merk;
            }

            echo '<label class="control-label" for="spare-part-detail-merk">Merk Spare Part</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_merk_spare_part,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#sparepartdetail-id_merk_spare_part').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SparePartDetail[id_merk_spare_part]',
            'value' => $the_merk_spare_part,
        ]);
        echo $form->field($model, 'id_merk_spare_part')
         ->textInput(["value" => $model->id_merk_spare_part, "readonly" => true])
         ->label(false);
    ?>
  

    <?= $form->field($model, 'jumlah')->textInput() ?>

   <?= $form->field($model, 'harga_beli')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>
  
   <?= $form->field($model, 'harga_jual')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
