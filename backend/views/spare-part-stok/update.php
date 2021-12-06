<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SparePartStok */

$this->title = 'Update Spare Part Stok: ' . $model->id_spare_part_stok;
$this->params['breadcrumbs'][] = ['label' => 'Spare Part Stoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_spare_part_stok, 'url' => ['view', 'id' => $model->id_spare_part_stok]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spare-part-stok-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
