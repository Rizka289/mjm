<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartStok */

$this->title = 'Create Spare Part Stok';
$this->params['breadcrumbs'][] = ['label' => 'Spare Part Stoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-stok-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
