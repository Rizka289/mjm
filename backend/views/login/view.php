<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use backend\models\Userrole;


/* @var $this yii\web\View */
/* @var $model backend\models\Login */
if (Yii::$app->user->isGuest) { 
   header("Location: index.php");
   exit;
}
$this->title = "View Detail Login";
$this->params['breadcrumbs'][] = ['label' => 'Data Login', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_login], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_login], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="box">
        <div class="box-header">
            <div class="col-md-4" style="padding: 0;">
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id_login',
                            'username',
                            'nama',
                            'alamat',
							[
								'attribute' => 'foto',
								'format'	=> 'html',
								'value'		=> function ($model)
								{
									return "<img src='upload/$model->foto' width='150'>";
								}
							],
                        ],
                    ]) ?>
                </div>

                <br>                               
                <label>HAK AKSES:</label><br>
                <?= Html::beginForm(['login/hakakses', 'id' => $model->id_login], 'post') ?>
                <?= Html::hiddenInput("id", $model->id_login) ?>
                
                <?php
                foreach ($hakakses as $data)
                {
                    $cek = Userrole::find()->where(["id_system_role"=>$data->id_system_role, "id_login"=>$model->id_login])->count();
                    $value = "0";
                    if ($cek > 0) $value = "1";

                    echo Html::checkbox('data['.$data->id_system_role.']', $value, ['label' => $data->nama_role]);
                    echo "<br>";
                }

                ?>  
                <?= Html::submitButton('Simpan Hak Akses', ['class' => 'btn btn-success']) ?>
                <?= Html::endForm() ?>  

            </div>
        </div>
    </div>
</div>
