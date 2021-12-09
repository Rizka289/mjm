<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;


?>

<div class="surat-jalan-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'tanggal_pengiriman')->textInput() ?>
       <?php
        $the_karyawan = "";
            if ($selected_karyawan != "") {
                $the_karyawan = $selected_karyawan->nama;
            }

            echo '<label class="control-label" for="invoice-nama">Nama Driver</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_karyawan,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#suratjalan-id_karyawan').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SuratJalan[id_karyawan]',
            'value' => $the_karyawan,
        ]);
        echo $form->field($model, 'id_karyawan')
         ->textInput(["value" => $model->id_karyawan, "readonly" => true])
         ->label(false);
    ?>
     <?php
        $the_unit = "";
            if ($selected_unit != "") {
                $the_unit = $selected_unit->nopol;
            }

            echo '<label class="control-label" for="invoice-nama">Nopol</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_unit,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#suratjalan-id_unit').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SuratJalan[id_unit]',
            'value' => $the_unit,
        ]);
        echo $form->field($model, 'id_unit')
         ->textInput(["value" => $model->id_unit, "readonly" => true])
         ->label(false);
    ?>
    <?= $form->field($model, 'tujuan')->textarea(['rows' => 3]) ?>
      <?php
        $the_kota = "";
            if ($selected_kota != "") {
                $the_kota = $selected_kota->kota;
            }

            echo '<label class="control-label" for="invoice-nama">Nama kota</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_kota,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#suratjalan-id_kota').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SuratJalan[id_kota]',
            'value' => $the_kota,
        ]);
        echo $form->field($model, 'id_kota')
         ->textInput(["value" => $model->id_kota, "readonly" => true])
         ->label(false);
    ?>
    
    <?= $form->field($model, 'status')->dropDownList(array(0=>"-",1=>"Completed",2=>"On Progress")) ?>
    

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
