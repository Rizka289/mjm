<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jasa */

$this->title = 'Create Jasa';
$this->params['breadcrumbs'][] = ['label' => 'Jasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
