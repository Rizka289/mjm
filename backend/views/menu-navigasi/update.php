<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuNavigasi */

$this->title = 'Update Menu Navigasi: ' . $model->id_menu;
$this->params['breadcrumbs'][] = ['label' => 'Menu Navigasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_menu, 'url' => ['view', 'id' => $model->id_menu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-navigasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menuParent' => $menuParent,
    ]) ?>

</div>
