<?php

use yii\helpers\Html;


$this->title = 'Tambah Rak';
$this->params['breadcrumbs'][] = ['label' => 'Raks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
