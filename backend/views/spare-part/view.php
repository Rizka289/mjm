<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Login;
use backend\models\Supplier;


$this->title = 'View Detail Spare Part :' . $model->no_nota_masuk;
$this->params['breadcrumbs'][] = ['label' => 'Spare Part', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="spare-part-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Perbarui', ['update', 'id' => $model->id_spare_part], ['class' => 'btn btn-primary']) ?>
    
        <?= Html::a('Hapus', ['delete', 'id' => $model->id_spare_part], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
             'method' => 'post',
            ],
        ]) ?>
        <?php
        if ($model->status_tempo != 1) {
            # code...
        ?>
        <?= Html::a('Input Spare Part', ['spare-part-detail/create', 'id' => $model->id_spare_part], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Telah Selesai', ['spare-part/selesai', 'id' => $model->id_spare_part], ['class' => 'btn btn-warning']) ?>
        <?php } ?>
        <?= Html::a('Cetak Nota', ['spare-part/print', 'id' => $model->id_spare_part], ['class' => 'btn btn-success']) ?>
           
    </p>
 <div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_nota_masuk',
            'no_nota_supplier',
           [
                'attribute' => 'id_supplier',
                'label' => 'Nama Supplier ',
                'value' => function ($model) {
                    if (!empty($model->supplier)) {
                        return $model->supplier->nama_supplier;
                    } else {
                        return "Data Supplier Sudah Hapus";
                    }
                }
            ],
            [
                'attribute' => 'id_supplier',
                'label' => 'No. Handphone',
                'value' => function ($model)  {
                    $submitter = Supplier::find()->where(["id_supplier"=>$model->id_supplier])->one();
                    if ($submitter != null){
                        return $submitter->no_hp;
                    } else {
                        return "Data Supplier Sudah Hapus";
                    }
                }
            ],
            'tanggal_masuk',
            [
                'attribute' => 'jns_pembayaran',
                'filter'    => array(
                    1 => "Cash",
                    2 => "Credit"
                ),
                'value'     => function ($model)
                {
                    if ($model->jns_pembayaran == 1) {
                        return "Cash";
                    } else {
                        return "Credit";
                    }
                }
            ],
            
            'tanggal_jatuh_tempo',
            [
                'attribute' => 'status_tempo',
                'label' => 'Status Jatuh Tempo',
                'format' => 'raw',
                'filter'    => array(
                    1 => "Tidak Jatuh Tempo (Transaksi Selesai)",
                    2 => "Belum Jatuh Tempo",
                    3 => "Sudah Jatuh Tempo",
                ),
                'value'     => function ($model)
                {
                    if ($model->status_tempo == 1) {
                        return  "<span class='label label-success' style='font-size: 90%'>Tidak Jatuh Tempo (Transaksi Selesai)</span>";
                    } else if ($model->status_tempo === 2) {
                        return  "<span class='label label-warning' style='font-size: 90%'>Belum Jatuh Tempo</span>";
                    }else {
                        return "<span class='label label-danger' style='font-size: 90%'>Sudah Jatuh Tempo</span>";
                    }
                }
            ],
            'jumlah_belanja',
            'dp',
            'sisa_pembayaran',
            [
				'attribute' 	=> 'Dibuat Oleh',
				'format'			=> 'html',
			    'value'			=> function ($model) 
				{
					$submitter = Login::find()->where(["id_login"=>$model->id_login])->one();
						if ($submitter != null){
							return $submitter->nama;
						} else {
							"";
						}
				}
			],
            
        ],
    ]) ?>

</div>
<div class="box">
<div class="col-md-12" style="padding: 0;">
<div class="box-body">
    <p><b>DAFTAR SPARE PART PEMBELIAN</b></p>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Spare Part</th>
                <th>Merk Spare Part</th>
                <th>Type</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Sub Total</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
   <tbody>
            <?php
            $no = 1;
            $total_harga = 0;
            $query    = Yii::$app->db->createCommand("SELECT * FROM spare_part_detail
                LEFT JOIN spare_part ON spare_part.id_spare_part = spare_part_detail.id_spare_part
                LEFT JOIN nama_spare_part ON nama_spare_part.id_nama_spare_part = spare_part_detail.id_nama_spare_part
                LEFT JOIN merk_spare_part ON merk_spare_part.id_merk = spare_part_detail.id_merk_spare_part
                WHERE spare_part_detail.id_spare_part = '$model->id_spare_part'")->query();
            foreach ($query as $key => $value) { ?>
            <?php
              $total_hargaa = $value['jumlah'] * $value['harga_beli'];
              $total_harga += $total_hargaa;
           ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['nama_spare_part'] ?></td>
                <td><?= $value['nama_merk'] ?></td>
                <td><?= $value['no_seri'] ?></td>
                <td><?= $value['jumlah'] ?></td>
                <td><?= 'Rp.' . ribuan($value['harga_beli']) ?></td>
                <td><?= 'Rp '. ribuan($total_hargaa) ?></td>
                <td><?= 'Rp' . ribuan($value['harga_jual']) ?></td>
                <td>
                    <?php if($value['status_stok'] == 0) { ?>
                        <?= Html::a('Hapus', ['spare-part-detail/delete', 'id' => $value['id_spare_part_detail'], 'id_spare_part' => $model->id_spare_part], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                 
                    <?php } ?>

                    <?php if($value['status_stok'] == 0) { ?>
                    <?= Html::a('Perbarui', ['spare-part-detail/update', 'id' => $value['id_spare_part_detail'], 'id_spare_part' => $model->id_spare_part], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Masukkan Stok', ['spare-part-detail/stok', 'id' => $value['id_spare_part_detail'], 'id_spare_part' => $model->id_spare_part], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Apakah anda yakin sudah selesai melakukan penginputan?',
                                'method' => 'post',
                            ],
                            ]) ?>
                   <?php } ?>
                </td>
              
            </tr>
            <?php } ?>
        </tbody>
       
         <tr>
            <th colspan="6">Total</th>
            <th style="text-align: left;"><?='Rp. ' . ribuan($total_harga) ?></th>
        </tr>
    </table>
    
</div>
    </table>
<!-- </div> -->
 <?= Html::beginForm(['spare-part/upload'], 'post', ['enctype' => 'multipart/form-data']) ?>
    <?= Html::hiddenInput("id_tabel",$model->id_spare_part) ?>
    <?= Html::hiddenInput("nama_tabel","spare_part") ?>
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
                                <th>FOTO SPARE PART / NOTA PEMBELIAN:</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <?php
                        foreach ($foto1 as $data1) {
                            echo "<div class='col-md-6'>";
                            echo "<a href='/mjm/backend/web/upload/" . $data1->foto . "' target='_blank'><img src='/mjm/backend/web/upload/" . $data1->foto . "' width='150'></a></a><br><a href='index.php?r=spare-part/view&id=".$model->id_spare_part."&id_hapus=".$data1->id_foto."' onclick=\"return confirm('Anda yakin ingin menghapus?')\"><img src='images/hapus.png' width='32'></a>";
                            echo "</div>";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
