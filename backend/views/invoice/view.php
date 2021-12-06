<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Login;
use backend\models\Customer;

$this->title = 'View Data Penjualan : '. $model->customer->nama_customer;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_invoice], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_invoice], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Tambah Spare Part', ['invoice-detail/create', 'id' => $model->id_invoice], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Cetak Nota', ['invoice/print', 'id' => $model->id_invoice], ['class' => 'btn btn-success']) ?>
         <?= Html::a('Telah Selesai', ['invoice/selesai', 'id' => $model->id_invoice], ['class' => 'btn btn-warning']) ?>
    </p>
<div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'no_invoice',
                            'customer.nama_customer',
                            [
                                'attribute' => 'id_customer',
                                'label' => 'No. Handphone',
                                'value' => function ($model)  {
                                    $submitter = Customer::find()->where(["id_customer"=>$model->id_customer])->one();
                                    if ($submitter != null){
                                        return $submitter->no_telp;
                                    } else {
                                        return "Data Supplier Sudah Hapus";
                                    }
                                }
                            ],
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
                            'tanggal_transaksi',
                            'tanggal_tagihan',
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
                            'dp',
                            'jumlah_belanja',
                            'sisa_pembayaran',
                            'keterangan:ntext',
                            // 'status',
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
    <p><b>DAFTAR SPARE PART PENJUALAN</b></p>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Spare Part</th>
                <th>Merk Spare Part</th>
                <th>Nomor Seri</th>
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Sub Total</th>
                <th>Diskon</br>(Harga)</th>
                <th>Diskon</br> (Persen)</th>
                <th>Setelah Diskon</th>
                <th>Aksi</th>
            </tr>
        </thead>
   <tbody>
            <?php
            $no = 1;
            $total_harga = 0;
            $total_diskon = 0;
            $query    = Yii::$app->db->createCommand("SELECT * FROM invoice_detail
                LEFT JOIN spare_part_stok ON spare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
                WHERE id_invoice = '$model->id_invoice'")->query();
            foreach ($query as $key => $value) { ?>
            <?php
              $total_hargaa = $value['jumlah_transaksi'] * $value['harga'];
              $total_diskon += $value['setelah_diskon']; 
              $total_harga += $total_hargaa;
           ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['nama_spare_part'] ?></td>
                <td><?= $value['merk_spare_part'] ?></td>
                <td><?= $value['no_seri'] ?></td>
                <td><?= $value['jumlah_transaksi'] ?></td>
                <td><?= 'Rp.' . ribuan($value['harga']) ?></td>
                <td><?= 'Rp.' . ribuan($total_hargaa) ?></td>
                <td><?= 'Rp.' . ribuan($value['diskon']) ?></td>
                <td><?= $value['diskon_persen'] ?> %</td>
                <td><?= 'Rp.' . ribuan($value['setelah_diskon']) ?></td>
                <td>
                    <?= Html::a('Delete', ['invoice-detail/delete', 'id' => $value['id_invoice_detail'], 'id_invoice' => $model->id_invoice], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <!-- <?= Html::a('Update', ['invoice-detail/update', 'id' => $value['id_invoice_detail'], 'id_invoice' => $model->id_invoice], ['class' => 'btn btn-primary']) ?> -->
                    <?= Html::a('Return', ['invoice-detail/return-penjualan', 'id' => $value['id_invoice_detail'], 'id_invoice' => $model->id_invoice], ['class' => 'btn btn-warning']) ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
       
         <tr>
            <th colspan="6">Total</th>
            <th style="text-align: left;"><?='Rp. ' . ribuan($total_harga) ?></th>
            <th colspan="2"></th>
            <th style="text-align: left;"><?='Rp. ' . ribuan($total_diskon) ?></th>
        </tr>
    </table>
</div>
    </table>

<!-- </div> -->
 <?= Html::beginForm(['invoice/upload'], 'post', ['enctype' => 'multipart/form-data']) ?>
    <?= Html::hiddenInput("id_tabel",$model->id_invoice) ?>
    <?= Html::hiddenInput("nama_tabel","invoice") ?>
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
                                <th>FOTO SPARE PART PENJUALAN</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <?php
                        foreach ($foto1 as $data1) {
                            echo "<div class='col-md-6'>";
                            echo "<a href='/mjm/backend/web/upload/" . $data1->foto . "' target='_blank'><img src='/mjm/backend/web/upload/" . $data1->foto . "' width='150'></a></a><br><a href='index.php?r=invoice/view&id=".$model->id_invoice."&id_hapus=".$data1->id_foto."' onclick=\"return confirm('Anda yakin ingin menghapus?')\"><img src='images/hapus.png' width='32'></a>";
                            echo "</div>";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

