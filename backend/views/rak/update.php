<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rak */

$this->title = 'Update Rak: ' . $model->nama_rak;
$this->params['breadcrumbs'][] = ['label' => 'Raks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rak, 'url' => ['view', 'id' => $model->id_rak]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
