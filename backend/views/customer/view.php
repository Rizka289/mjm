<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



$this->title = 'Data Customer : '.$model->nama_customer;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_customer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_customer], [
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
                            // 'id_customer',
                            'nama_customer',
                            'alamat',
                            'no_telp',
                            'kota',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?= Html::beginForm(['customer/upload'], 'post', ['enctype' => 'multipart/form-data']) ?>
    <?= Html::hiddenInput("id_tabel",$model->id_customer) ?>
    <?= Html::hiddenInput("nama_tabel","customer") ?>
    <div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>UPLOAD FOTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class = 'btn btn-warning' type="file" name="foto" id="exampleInputFile"><br>   
                                    <b style="color: red;">Catatan:<br>- File harus bertype jpg, png.<br>- Ukuran maksimal 2 MB.</b>  
                                </td>
                                <td>
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>FOTO Customer :</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <?php
                        foreach ($foto1 as $data1) {
                            echo "<div class='col-md-6'>";
                            echo "<a href='/mjm/backend/web/upload/" . $data1->foto . "' target='_blank'><img src='/mjm/backend/web/upload/" . $data1->foto . "' width='150'></a></a><br><a href='index.php?r=customer/view&id=".$model->id_customer."&id_hapus=".$data1->id_foto."' onclick=\"return confirm('Anda yakin ingin menghapus?')\"><img src='images/hapus.png' width='32'></a>";
                            echo "</div>";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
