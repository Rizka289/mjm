<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Unit */

$this->title = 'Update Unit: ' . $model->id_unit;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unit, 'url' => ['view', 'id' => $model->id_unit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
