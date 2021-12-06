<?php

use yii\helpers\Html;

$this->title = 'Create Spare Part Detail';
$this->params['breadcrumbs'][] = ['label' => 'Spare Part Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-part-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'array_nama_spare_part' => $array_nama_spare_part,
        'array_merk_spare_part' => $array_merk_spare_part,
        'selected_nama_spare_part' => $selected_nama_spare_part,
        'selected_merk_spare_part' => $selected_merk_spare_part,
    ]) ?>

</div>
