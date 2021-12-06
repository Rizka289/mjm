<?php

use yii\helpers\Html;


$this->title = 'Tambah Spare Part';
$this->params['breadcrumbs'][] = ['label' => 'Spare Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_supplier' => $array_supplier,
        'selected_supplier' => $selected_supplier,
    ]) ?>

</div>
