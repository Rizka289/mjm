<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jasa */

$this->title = 'Update Jasa: ' . $model->id_jasa;
$this->params['breadcrumbs'][] = ['label' => 'Jasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jasa, 'url' => ['view', 'id' => $model->id_jasa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jasa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
