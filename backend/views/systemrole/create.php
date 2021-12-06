<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Systemrole */
if (Yii::$app->user->isGuest) { 
    header("Location: index.php");
    exit;
 }
$this->title = 'Create Hak Akses';
$this->params['breadcrumbs'][] = ['label' => 'Data Hak Akses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemrole-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
