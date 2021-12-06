<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = 'Data Detail Rak :'. $model->nama_rak;
$this->params['breadcrumbs'][] = ['label' => 'Raks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_rak], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_rak], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
 <div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id_rak',
                        'nama_rak',
                    ],
                ]) ?>

            </div>
