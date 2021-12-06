<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
// use yii\helpers\Html;   

use backend\models\MerkSparePart;
use backend\models\Rak;
use backend\models\Supplier;
use backend\models\Uom;

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;


?>

<div class="spare-part-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>
   

    <?= $form->field($model, 'no_nota_masuk')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'no_nota_supplier')->textInput() ?>
    
    <?php
        $the_supplier = "";
            if ($selected_supplier != "") {
                $the_supplier = $selected_supplier->nama_supplier;
            }

            echo '<label class="control-label" for="spare-part-nama">Nama supplier</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_supplier,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#sparepart-id_supplier').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'SparePart[id_supplier]',
            'value' => $the_supplier,
        ]);
        echo $form->field($model, 'id_supplier')
         ->textInput(["value" => $model->id_supplier, "readonly" => true])
         ->label(false);
    ?>

    <?= $form->field($model, 'jns_pembayaran')->dropDownList(array(0=>"-Pilih-",1=>"Cash",2=>"Kredit"),['onchange'=>'setDateTempo()']) ?>

    <?= $form->field($model, 'tanggal_masuk')->widget(\yii\jui\DatePicker::classname(), [
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($model, 'tanggal_jatuh_tempo')->widget(\yii\jui\DatePicker::classname(), [
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>
    
    <?= $form->field($model, 'jumlah_belanja')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>
    
    <?= $form->field($model, 'dp')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    const jnpay =  document.getElementById('sparepart-jns_pembayaran');

jnpay.addEventListener("change", (e)=>{
    if (e.target.value == 1) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

    const tempo =  document.getElementById('sparepart-tanggal_jatuh_tempo');
        tempo.value=yyyy+"-"+mm+"-"+dd;
        console.log('haap',yyyy+"-"+mm+"-"+dd)
    }
});
    

</script>