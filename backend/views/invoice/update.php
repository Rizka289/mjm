<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoice */

$this->title = 'Update Invoice: ' . $model->id_invoice;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_invoice, 'url' => ['view', 'id' => $model->id_invoice]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
          'array_customer' => $array_customer,
            'selected_customer' => $selected_customer,
    ]) ?>

</div>
