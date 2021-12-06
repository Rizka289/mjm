<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\return */

$this->params['breadcrumbs'][] = ['label' => 'return', 'url' => ['lock']];
$this->params['breadcrumbs'][] = ['label' => $model->id_return, 'url' => ['view', 'id' => $model->id_return]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="return-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formreturn', [
        'model' => $model,
    ]) ?>

</div>
