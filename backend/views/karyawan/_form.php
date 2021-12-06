<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
?>


<div class="karyawan-form">
<div class="box">
<div class="box-header">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">
   

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(\yii\jui\DatePicker::classname(), [
            'clientOptions' => [
                        'changeMonth'=>true, 
                        'changeYear'=>true,
            ],
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(array(0=>"Perempuan",1=>"laki-laki")) ?>

    <?= $form->field($model, 'pendidikan_terakhir')->dropDownList(array(0=>"-",1=>"SD/MI",2=>"SMP/MTS",3=>"SMA/SMK/MA",4=>"D1",5=>"D2",6=>"D3",7=>"S1",8=>"S2",9=>"S3")) ?>

    <?= $form->field($model, 'agama')->dropDownList(array(0=>"-",1=>"Islam",2=>"Katolik",3=>"Kristen",4=>"Hindu",5=>"Budha",6=>"Konghucu",7=>"Kepercayaan")) ?>

    <?= $form->field($model, 'status_karyawan')->dropDownList(array(0=>"-",1=>"Magang",2=>"Kontrak",3=>"Tetap",4=>"Keluar",5=>"PHK")) ?>

    <?= $form->field($model, 'tanggal_masuk')->widget(\yii\jui\DatePicker::classname(), [
            'clientOptions' => [
                        'changeMonth'=>true, 
                        'changeYear'=>true,
            ],
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($model, 'tanggal_keluar')->widget(\yii\jui\DatePicker::classname(), [
            'clientOptions' => [
                        'changeMonth'=>true, 
                        'changeYear'=>true,
            ],
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
