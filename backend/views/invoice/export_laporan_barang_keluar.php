<?php

use backend\models\InvoiceDetail;
use backend\models\Invoice;
use backend\models\Customer;
?>
<style>
    table,
    th {
        border: 1px solid #888888;
        text-align: center;
        font-size: 13px;
    }

    th {
        border: 1px solid #888888;
        text-align: center;
    }

    td {
        border: 1px solid #888888;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 3px;
    }

    @media print {
        @page {
            size: auto;
            margin: 10px;
        }
    }
</style>

<table class="table">
    <!-- <thead> -->
    <tr>
        <th colspan="13">Laporan Spare Part Keluar / Penjualan Pertanggal : <?= date('d/m/Y', strtotime($tanggal_awal)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></th>
    </tr>
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
    <?php
        $no = 1;
        $totalan_harga_spare_part = 0;
        $totalan_harga_setelah_diskon = 0;

        $filter_tanggal = "";
            if ($tanggal_awal != 0 && $tanggal_akhir != 0) {
                $filter_tanggal = " AND date_format(invoice.tanggal_transaksi,  '%Y-%m-%d') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
                } elseif ($tanggal_awal == "" && $tanggal_akhir == "") {
                  $hari_ini = date('Y-m-d');
                  $filter_tanggal = " AND date_format(invoice.tanggal_transaksi,  '%Y-%m-%d') BETWEEN '$hari_ini' AND '$hari_ini' ";
                }

                $filter_nama_customer = "";
                    if ($nama_customer != 0) {
                        $filter_nama_customer = " AND invoice.id_customer = '$nama_customer' ";
                    }

                $penggunaan_spare_part = Yii::$app->db->createCommand("SELECT invoice_detail.diskon, invoice_detail.diskon_persen, invoice.no_invoice, customer.nama_customer, spare_part_stok.nama_spare_part, invoice.tanggal_transaksi, invoice_detail.jumlah_transaksi,invoice_detail.setelah_diskon, spare_part_stok.harga, spare_part_stok.no_seri,spare_part_stok.merk_spare_part
                FROM invoice_detail
                LEFT JOIN invoice ON invoice.id_invoice = invoice_detail.id_invoice
                LEFT JOIN customer ON customer.id_customer = invoice.id_customer
                LEFT JOIN spare_part_stok ON spare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
                WHERE 1
                $filter_tanggal
                $filter_nama_customer
                ORDER BY invoice.tanggal_transaksi ASC
                ")->query();
                foreach ($penggunaan_spare_part as $key => $data) {
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
    <tr>
       <th colspan="9">Total</th>
       <td align="right"><strong><?= ribuan($totalan_harga_spare_part) ?></strong></td>
       <th colspan="2"></th>
       <td align="right"><strong><?= ribuan($totalan_harga_setelah_diskon) ?></strong></td>
    </tr>
</table>
<?php
$fileName = "Export Laporan Barang Keluar : " . date('d/m/Y', strtotime($tanggal_awal)) . " s/d " . date('d/m/Y', strtotime($tanggal_akhir)) . ").xls";
header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/vnd.ms-excel");
?>