<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Uom */

$this->title = 'Tambah Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
