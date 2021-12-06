<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;


?>
<div class="nama-barang-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_spare_part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_seri')->textInput(['maxlength' => true]) ?>
    <?php
        $the_rak = "";
            if ($selected_rak != "") {
                $the_rak = $selected_rak->nama_rak;
            }

            echo '<label class="control-label" for="nama-spare-part-nama">Lokasi rak</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_rak,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#namasparepart-nama_rak').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'NamaSparePart[nama_rak]',
            'value' => $the_rak,
        ]);
        echo $form->field($model, 'nama_rak')
         ->textInput(["value" => $model->nama_rak, "readonly" => true])
         ->label(false);
    ?>

        
    <?= $form->field($model, 'stok_minimal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
