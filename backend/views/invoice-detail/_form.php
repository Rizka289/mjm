<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use backend\models\SparePartStok;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;

?>

<div class="invoice-detail-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
     <?= $form->field($model, 'id_invoice')->textInput(['readonly' => true, 'value' => $_GET['id'], 'type' => 'hidden'])->label(false) ?>

      <?php
        $the_spare_part_stok = "";
            if ($selected_array_spare_part_stok != "") {
                $the_spare_part_stok = $selected_array_spare_part_stok->nama_spare_part;
            }

            echo '<label class="control-label" for="invoice-detail-nama">Nama Spare Part</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_spare_part_stok,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#invoicedetail-id_spare_part_stok').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'InvoiceDetail[id_spare_part_stok]',
            'value' => $the_spare_part_stok,
        ]);
        echo $form->field($model, 'id_spare_part_stok')
         ->textInput(["value" => $model->id_spare_part_stok, "readonly" => true])
         ->label(false);
    ?>

    <?= $form->field($model, 'jumlah_transaksi')->textInput() ?>

    <?= $form->field($model, 'diskon')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>

    <?= $form->field($model, 'diskon_persen')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
