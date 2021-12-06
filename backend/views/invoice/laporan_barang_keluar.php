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
use backend\models\Customer;



$this->title = 'Laporan Penjualan Spare Part';
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
                            <?= Html::beginForm(['laporan-barang-keluar', array('class' => 'form-inline')]) ?>

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
                                        <div class="form-group">Nama Customer</div>
                                    </td>
                                    <td align="center">
                                        <div class="form-group">:</div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <?php
                                            echo AutoComplete::widget([
                                                'clientOptions' => [
                                                    'source' => $array_customer,
                                                    'minLength' => '1',
                                                    'autoFill' => true,
                                                    'select' => new JsExpression("function( event, ui ) { $('#nama_customer').val(ui.item.id); }")
                                                ],
                                                'options' => ['class' => 'form-control', 'placeholder' => 'Nama Customer'],
                                                'name' => 'nama_customer',
                                                'value' => '',
                                            ]);

                                            echo Html::textInput('nama_customer', '', ['class' => 'form-control', 'id' => 'nama_customer', 'readonly' => true]);

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
                                            $nama_customer_ = ($nama_customer == "") ? "" : $nama_customer;
                                            // var_dump($customer_);die;
                                            ?>
                                            <?= Html::a(
                                                'Cetak Laporan',
                                                [
                                                    'cetak-laporan-barang-keluar',
                                                    'tanggal_awal' => $tanggal_awal_,
                                                    'tanggal_akhir' => $tanggal_akhir_,
                                                    'nama_customer' => $nama_customer_,
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
                                                    'export-laporan-barang-keluar',
                                                    'tanggal_awal' => $tanggal_awal_,
                                                    'tanggal_akhir' => $tanggal_akhir_,
                                                    'nama_customer' => $nama_customer_,
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
        <h4>Laporan Spare Part Keluar</h4>
        <table class="tabel">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>: <?= ($tanggal_awal != '') ? date('d/m/Y', strtotime($tanggal_awal)) : date('d/m/Y'); ?> s/d <?= ($tanggal_akhir != '') ? date('d/m/Y', strtotime($tanggal_akhir)) : date('d/m/Y'); ?></th>
                </tr>
                <?php
                if (!empty($nama_customer)) {
                    # code...
                    $data_customer = Customer::findOne($nama_customer);
                ?>
                    <tr>
                        <th>Nama Customer</th>
                        <th>: <?= $data_customer->nama_customer ?></th>
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
                                <th style="width: 5%;white-space: nowrap;">No. Penjualan</th>
                                <th style="width: 5%;white-space: nowrap;">Nama Customer</th>
                                <th style="width: 5%;white-space: nowrap;">Nama Spare Part</th>
                                <th style="width: 5%;white-space: nowrap;">No. Seri</th>
                                <th style="width: 5%;white-space: nowrap;">Merk</th>
                                <th style="width: 5%;white-space: nowrap;">Tanggal Penjualan</th>
                                <th style="width: 5%;white-space: nowrap;">Jumlah</th>
                                <th style="width: 5%;white-space: nowrap;">Harga</th>
                                <th style="width: 5%;white-space: nowrap;">Sub Total</th>
                                <th style="width: 5%;white-space: nowrap;">Diskon (Harga)</th>
                                <th style="width: 5%;white-space: nowrap;">Diskon (Persen)</th>
                                <th style="width: 5%;white-space: nowrap;">Harga Setelah Diskon</th>
                            </tr>
                        </thead>
                      
                       <tbody>
                            <?php
                            $no = 1;
                            $totalan_harga_spare_part = 0;
                            $totalan_harga_setelah_diskon = 0;

                            $filter_tanggal = "";
                            if ($tanggal_awal != 0 && $tanggal_akhir != 0) {
                                $filter_tanggal = " AND date_format(invoice.tanggal_transaksi,  '%Y-%m-%d') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
                            } elseif ($tanggal_awal == "" && $tanggal_akhir == "") {
                                # code...
                                $hari_ini = date('Y-m-d');
                                $filter_tanggal = " AND date_format(invoice.tanggal_transaksi,  '%Y-%m-%d') BETWEEN '$hari_ini' AND '$hari_ini' ";
                            }

                            $filter_nama_customer = "";
                            if ($nama_customer != 0) {
                                $filter_nama_customer = " AND invoice.id_customer = '$nama_customer' ";
                            }

                            $penggunaan_spare_part = Yii::$app->db->createCommand("SELECT invoice_detail.setelah_diskon,invoice_detail.diskon_persen, invoice_detail.diskon,invoice.no_invoice, customer.nama_customer, spare_part_stok.nama_spare_part, invoice.tanggal_transaksi, invoice_detail.jumlah_transaksi, spare_part_stok.harga, spare_part_stok.no_seri,spare_part_stok.merk_spare_part
                            FROM invoice_detail
                            LEFT JOIN invoice ON invoice.id_invoice = invoice_detail.id_invoice
                            LEFT JOIN customer ON customer.id_customer = invoice.id_customer
                            LEFT JOIN spare_part_stok ON spare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
                            WHERE 1
                            $filter_tanggal
                            $filter_nama_customer
                            ORDER BY invoice.tanggal_transaksi ASC
                            ")->query();
                            // var_dump($filter_nama_customer);die;

                            foreach ($penggunaan_spare_part as $key => $data) {
                                # code..
                                // var_dump($penggunaan_spare_part);die;
                                $sub_total = $data['harga'] * $data['jumlah_transaksi'];
                                $totalan_harga_spare_part += $sub_total;
                                $totalan_harga_setelah_diskon += $data['setelah_diskon'];
                                // var_dump($data);die;
                            ?>
                                <tr>
                                    <td><?= $no++ . '.' ?></td>
                                    <td style="white-space: nowrap;"><?= $data['no_invoice'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['nama_customer'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['nama_spare_part'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['no_seri'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['merk_spare_part'] ?></td>
                                    <td style="text-align: center;"><?= date('d/m/Y', strtotime($data['tanggal_transaksi'])) ?></td>
                                    <td style="white-space: nowrap;"><?= $data['jumlah_transaksi'] ?></td>
                                    <td style="white-space: nowrap;"><?= $data['harga'] ?></td>
                                    <td align="right"><?= ribuan($sub_total) ?></td>
                                    <td style="white-space: nowrap;"><?= ribuan( $data['diskon']) ?></td>
                                    <td style="white-space: nowrap;"><?= ribuan( $data['diskon_persen']) ?></td>
                                    <td style="white-space: nowrap;"><?= ribuan( $data['setelah_diskon']) ?></td>
                                
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="9">Total</th>
                                <td align="right"><strong><?= ribuan($totalan_harga_spare_part) ?></strong></td>
                                <th colspan="2"></th>
                                <td align="right"><strong><?= ribuan($totalan_harga_setelah_diskon) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
  