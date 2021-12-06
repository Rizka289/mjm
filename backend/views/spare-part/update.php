<?php

use yii\helpers\Html;


$this->title = 'Update Spare Part: ' . $model->id_spare_part;
$this->params['breadcrumbs'][] = ['label' => 'Spare Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_spare_part, 'url' => ['view', 'id' => $model->id_spare_part]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spare-part-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_supplier' => $array_supplier,
        'selected_supplier' => $selected_supplier,
    ]) ?>

</div>
