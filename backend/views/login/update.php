<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Login */
if (Yii::$app->user->isGuest) { 
   header("Location: index.php");
   exit;
}
$this->title = 'Update ID Login: ' . $model->id_login;
$this->params['breadcrumbs'][] = ['label' => 'Data Login', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "View Detail", 'url' => ['view', 'id' => $model->id_login]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="login-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		
    ]) ?>

</div>
