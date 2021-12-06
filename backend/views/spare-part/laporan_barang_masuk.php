<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use backend\models\InvoiceDetail;
use backend\models\Invoice;
use backend\models\Supplier;



$this->title = 'Laporan Pembelian Spare Part';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <div class="invoice-view">

        <h4><?= Html::encode($this->title) ?></h4>

        <div class="box">
            <div class="box-header">
                <div class="col-md-12" style="padding: 0;">
                    <div class="box-body">
                        <div>
                            <?= Html::beginForm(['laporan-barang-masuk', array('class' => 'form-inline')]) ?>

                            <table border="0" width="100%">
                                <tr>
                                    <td width="10%">
                                        <div class="form-group">Dari Tanggal</div>
                                    </td>
                                    <td align="center" width="5%">
                                        <div class="form-group">:</div>
                                    </td>
                                    <td width="30%">
                                        <div class="form-group">
                                            <input type="date" name="tanggal_awal" class="form-control" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="10%">
                                        <div class="form-group">Sampai Tanggal</div>
                                    </td>
                                    <td align="center" width="5%">
                                        <div class="form-group">:</div>
                                    </td>
                                    <td width="30%">
                                        <div class="form-group">
                                            <input type="date" name="tanggal_akhir" class="form-control" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">Nama Supplier</div>
                                    </td>
                                    <td align="center">
                                        <div class="form-group">:</div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <?php
                                            echo AutoComplete::widget([
                                                'clientOptions' => [
                                                    'source' => $array_supplier,
                                                    'minLength' => '1',
                                                    'autoFill' => true,
                                                    'select' => new JsExpression("function( event, ui ) { $('#nama_supplier').val(ui.item.id); }")
                                                ],
                                                'options' => ['class' => 'form-control', 'placeholder' => 'Nama Supplier'],
                                                'name' => 'nama_supplier',
                                                'value' => '',
                                            ]);

                                            echo Html::textInput('nama_supplier', '', ['class' => 'form-control', 'id' => 'nama_supplier', 'readonly' => true]);

                                            ?>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                                            <?php
                                            $tanggal_awal_ = ($tanggal_awal == "") ? date('Y-m-d') : $tanggal_awal;
                                            $tanggal_akhir_ = ($tanggal_akhir == "") ? date('Y-m-d') : $tanggal_akhir;
                                            $nama_supplier_ = ($nama_supplier == "") ? "" : $nama_supplier;
                                            // var_dump($customer_);die;
                                            ?>
                                            <?= Html::a(
                                                'Cetak Laporan',
                                                [
                                                    'cetak-barang-masuk',
                                                    'tanggal_awal' => $tanggal_awal_,
                                                    'tanggal_akhir' => $tanggal_akhir_,
                                                    'nama_supplier' => $nama_supplier_,
                                                ],
                                                [
                                                    'class' => 'btn btn-primary',
                                                    'target' => '_blank',
                                                    'method' => 'post'
                                                ]
                                            ) ?>
                                            <?= Html::a(
                                                'Export Laporan',
                                                [
                                                    'export-laporan-barang-masuk',
                                                    'tanggal_awal' => $tanggal_awal_,
                                                    'tanggal_akhir' => $tanggal_akhir_,
                                                    'nama_supplier' => $nama_supplier_,
                                                ],
                                                [
                                                    'class' => 'btn btn-success',
                                                    'target' => '_blank',
                                                    'method' => 'post'
                                                ]
                                            ) ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <?= Html::endForm() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .tabel th {
                padding: 3px;
            }
        </style>

    <p style="font-family: 'Times New Roman'">
        <h4>Laporan Pembelian Spare Part</h4>
        <table class="tabel">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>: <?= ($tanggal_awal != '') ? date('d/m/Y', strtotime($tanggal_awal)) : date('d/m/Y'); ?> s/d <?= ($tanggal_akhir != '') ? date('d/m/Y', strtotime($tanggal_akhir)) : date('d/m/Y'); ?></th>
                </tr>
                <?php
                if (!empty($nama_supplier)) {
                    # code...
                    $data_supplier= Supplier::findOne($nama_supplier);
                ?>
                    <tr>
                        <th>Nama Customer</th>
                        <th>: <?= $data_supplier->nama_supplier ?></th>
                    </tr>
                <?php } ?>
            </thead>
        </table>
    </p>
    <div class="box">
        <div class="box-header">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body" style="overflow-x: scroll;">

                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1%;">No</th>
                                <th style="width: 5%;white-space: nowrap;">No. Nota Masuk</th>
                                <th style="width: 5%;white-space: nowrap;">No. Nota Supplier </th>
                                <th style="width: 5%;white-space: nowrap;">Nama Supplier </th>
                                <th style="width: 5%;white-space: nowrap;">Nama Spare Part</th>
                                <th style="width: 5%;white-space: nowrap;">No. Seri</th>
                                <th style="width: 5%;white-space: nowrap;">Merk</th>
                                <th style="width: 5%;white-space: nowrap;">Tanggal Masuk</th>
                                <th style="width: 5%;white-space: nowrap;">Jumlah</th>
                                <th style="width: 5%;white-space: nowrap;">Harga</th>
                                <th style="width: 5%;white-space: nowrap;">Sub Total</th>
                                <th style="width: 5%;white-space: nowrap;">Jenis Pembayaran</th>
                            </tr>
                        </thead>
                     <tbody>
                            <?php
                            $no = 1;
                            $totalan_harga_spare_part = 0;

                            $filter_tanggal = "";
                            if ($tanggal_awal != 0 && $tanggal_akhir != 0) {
                                $filter_tanggal = " AND date_format(spare_part.tanggal_masuk,  '%Y-%m-%d') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
                            } elseif ($tanggal_awal == "" && $tanggal_akhir == "") {
                                # code...
                                $hari_ini = date('Y-m-d');
                                $filter_tanggal = " AND date_format(spare_part.tanggal_masuk,  '%Y-%m-%d') BETWEEN '$hari_ini' AND '$hari_ini' ";
                            }

                            $filter_nama_supplier = "";
                            if ($nama_supplier != 0) {
                                $filter_nama_supplier = " AND spare_part.id_supplier = '$nama_supplier' ";
                            }

                            $penggunaan_spare_part = Yii::$app->db->createCommand("SELECT spare_part_detail.status_stok, spare_part.no_nota_masuk,spare_part.jns_pembayaran, supplier.nama_supplier, spare_part.no_nota_supplier, spare_part.tanggal_masuk, spare_part_detail.jumlah, spare_part_detail.harga_beli, nama_spare_part.nama_spare_part,nama_spare_part.no_seri,merk_spare_part.nama_merk
                            FROM spare_part_detail
                            LEFT JOIN nama_spare_part ON nama_spare_part.id_nama_spare_part = spare_part_detail.id_nama_spare_part
                            LEFT JOIN merk_spare_part ON merk_spare_part.id_merk = spare_part_detail.id_merk_spare_part
                            LEFT JOIN spare_part ON spare_part.id_spare_part = spare_part_detail.id_spare_part
                            LEFT JOIN supplier ON supplier.id_supplier = spare_part.id_supplier
                            WHERE spare_part_detail.status_stok = '1'
                            $filter_tanggal
                            $filter_nama_supplier
                            ORDER BY spare_part.tanggal_masuk ASC
                            ")->query();
                            // var_dump($filter_nama_customer);die;

                            foreach ($penggunaan_spare_part as $key => $data) {
                                # code..
                                // var_dump($penggunaan_spare_part);die;
                                $sub_total = $data['harga_beli'] * $data['jumlah'];
                                $totalan_harga_spare_part += $sub_total;
                                // var_dump($data);die;
                            ?>
                                <tr>
                                    <td><?= $no++ . '.' ?></td>
                                    <td style="white-space: nowrap;"><?= $data['no_nota_masuk'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['no_nota_supplier'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['nama_supplier'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['nama_spare_part'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['no_seri'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['nama_merk'] ?></td>
                                    <td style="text-align: center;"><?= date('d/m/Y', strtotime($data['tanggal_masuk'])) ?></td>
                                    <td style="white-space: nowrap;"><?= $data['jumlah'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['harga_beli'] ?></td>
                                    <td align="right"><?= ribuan($sub_total) ?></td>
                                    <td align="right"><?php if ($data['jns_pembayaran'] == 1) {
                                        echo " Cash";
                                    }else {
                                        echo "Credit";
                                    } ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="10">Total</th>
                                <td align="right"><strong><?= ribuan($totalan_harga_spare_part) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
