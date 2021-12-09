<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="karyawan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_karyawan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_karyawan], [
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
            // 'id_karyawan',
            'nik',
            'nama',
            [
                'attribute' => 'jenis_kelamin',
                'filter'    => array(
                    0 => "Perempuan",
                    1 => "Laki-laki"
                ),
                'value'     => function ($model)
                {
                    if ($model->jenis_kelamin == 0) {
                        return "Perempuan";
                    } else {
                        return "Laki-laki";
                    }
                }
            ],
            'tempat_lahir',
            [
                'attribute' => 'tanggal_lahir',
                'value'     => function ($model)
                {
                    if ($model->tanggal_lahir == 0) {
                        return "00-00-0000";
                    } else {
                        return Yii::$app->formatter->asDate($model->tanggal_lahir, 'php:d-m-Y');;
                    }
                }
            ],
            'alamat',
            [
                'attribute' => 'pendidikan_terakhir',
                'filter'    => array(
                    0 => "-",
                    1 => "SD/MI",
                    2 => "SMP/MTS",
                    3 => "SMA/SMK/MA",
                    4 => "D1",
                    5 => "D2",
                    6 => "D3",
                    7 => "S1", 
                    8 => "S2", 
                    9 => "S3" 
                ),
                'value'     => function ($model)
                {
                    if ($model->pendidikan_terakhir == 0) {
                        return "-";
                    } elseif ($model->pendidikan_terakhir == 1) {
                        return "SD";
                    } elseif ($model->pendidikan_terakhir == 2) {
                        return "SMP/MTS";
                    } elseif ($model->pendidikan_terakhir == 3) {
                        return "SMA/SMK/MA";
                    } elseif ($model->pendidikan_terakhir == 4) {
                        return "D1";
                    } elseif ($model->pendidikan_terakhir == 5) {
                        return "D2";
                    } elseif ($model->pendidikan_terakhir == 6) {
                        return "D3";
                    } elseif ($model->pendidikan_terakhir == 7) {
                        return "S1";
                    } elseif ($model->pendidikan_terakhir == 9) {
                        return "S2";
                    } else {
                        return "S3";
                    }
                }
            ],
           
             [
                'attribute' => 'agama',
                'filter'    => array(
                    0 => "-",
                    1 => "Islam",
                    2 => "Katolik",
                    3 => "Kristen",
                    4 => "Hindu",
                    5 => "Budha",
                    6 => "Konghucu",
                    7 => "Kepercayaan" 
                ),
                'value'     => function ($model)
                {
                    if ($model->agama == 0) {
                        return "-";
                    } elseif ($model->agama == 1) {
                        return "Islam";
                    } elseif ($model->agama == 2) {
                        return "Katolik";
                    } elseif ($model->agama == 3) {
                        return "Kristen";
                    } elseif ($model->agama == 4) {
                        return "Hindu";
                    } elseif ($model->agama == 5) {
                        return "Budha";
                    } elseif ($model->agama == 6) {
                        return "Konghucu";
                    } else {
                        return "Kepercayaan";
                    }
                }
            ],
            [
                'attribute' => 'status_karyawan',
                'filter'    => array(
                    0 => "-",
                    1 => "Magang",
                    2 => "Kontrak",
                    3 => "Tetap",
                    4 => "Aktif",
                    5 => "Keluar",
                    6 => "PHK" 
                ),
                'value'     => function ($model)
                {
                    if ($model->status_karyawan == 0) {
                        return "-";
                    } elseif ($model->status_karyawan == 1) {
                        return "Magang";
                    } elseif ($model->status_karyawan == 2) {
                        return "Kontrak";
                    } elseif ($model->status_karyawan == 3) {
                        return "Tetap";
                    } elseif ($model->status_karyawan == 4) {
                        return "Keluar";
                    } else {
                        return "PHK";
                    }
                }
            ],
             [
                'attribute' => 'tanggal_masuk',
                'value'     => function ($model)
                {
                    if ($model->tanggal_masuk == 0) {
                        return "00-00-0000";
                    } else {
                        return Yii::$app->formatter->asDate($model->tanggal_masuk, 'php:d-m-Y');;
                    }
                }
            ],
            [
                'attribute' => 'tanggal_keluar',
                'value'     => function ($model)
                {
                    if ($model->tanggal_keluar == 0) {
                        return "00-00-0000";
                    } else {
                        return Yii::$app->formatter->asDate($model->tanggal_keluar, 'php:d-m-Y');;
                    }
                }
            ],
        ],
    ]) ?>

</div>
<?= Html::beginForm(['karyawan/upload'], 'post', ['enctype' => 'multipart/form-data']) ?>
<?= Html::hiddenInput("id_tabel",$model->id_karyawan) ?>
<?= Html::hiddenInput("nama_tabel","karyawan") ?>
<div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>UPLOAD FOTO / DOKUMEN</th>
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
<div class="col-md-12" style="padding: 0;">
<div class="box-body">
    <table class="table">
        <thead>
            <tr>
                <th>FOTO PROFIL &DOKUMEN :</th>
            </tr>
        </thead>
    </table>
    <div class="row">
        <?php 
        foreach ($foto as $data)
        {
            echo "<div class='col-md-6'>";
            echo "<a href='/mjm/backend/web/upload/".$data->foto."' target='_blank'><img src='/mjm/backend/web/upload/".$data->foto."' width='150'></a><br><a href='index.php?r=karyawan/view&id=".$model->id_karyawan."&id_hapus=".$data->id_foto."' onclick=\"return confirm('Anda yakin ingin menghapus?')\"><img src='images/hapus.png' width='32'></a>";
            echo "</div>";
        }
        
        ?>
    </div>
</div>
<div class="box">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">