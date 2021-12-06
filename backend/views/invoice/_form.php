<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use backend\models\Customer;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;

?>

<div class="invoice-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">

   <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'no_invoice')->textInput(['readonly' => true]) ?>
     <?php
        $the_customer = "";
            if ($selected_customer != "") {
                $the_customer = $selected_customer->nama_customer;
            }

            echo '<label class="control-label" for="invoice-nama">Nama Customer</label><br>';
            echo AutoComplete::widget([
            'clientOptions' => [
                'source' => $array_customer,
                'minLength' => '1',
                'autoFill' => true,
                'select' => new JsExpression("function( event, ui ) {
                $('#invoice-id_customer').val(ui.item.id);                            
            }")
           ],
            'options' => ['class' => 'form-control'],
            'name' => 'Invoice[id_customer]',
            'value' => $the_customer,
        ]);
        echo $form->field($model, 'id_customer')
         ->textInput(["value" => $model->id_customer, "readonly" => true])
         ->label(false);
    ?>
    <?= $form->field($model, 'jns_pembayaran')->dropDownList(array(0=>"-",1=>"Cash",2=>"Kredit")) ?>
    <?= $form->field($model, 'tanggal_transaksi')->widget(\yii\jui\DatePicker::classname(), [
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>
    <?= $form->field($model, 'tanggal_tagihan')->widget(\yii\jui\DatePicker::classname(), [
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
        ],
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>
    
    <?= $form->field($model, 'dp')->widget(\yii\widgets\MaskedInput::className(), ['clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false, 'min' => 0]]); ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    const jnpay =  document.getElementById('invoice-jns_pembayaran');

jnpay.addEventListener("change", (e)=>{
    if (e.target.value == 1) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

    const tempo =  document.getElementById('invoice-tanggal_tagihan');
        tempo.value=yyyy+"-"+mm+"-"+dd;
        console.log('haap',yyyy+"-"+mm+"-"+dd)
    }
});
    

</script>
