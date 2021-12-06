<?php

$tanggal1 = $_GET['tanggal1'];
$tanggal2 = $_GET['tanggal2'];

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
        <th colspan="11">Laporan Laba Rugi : <?= date('d/m/Y', strtotime($tanggal1)) ?> s/d <?= date('d/m/Y', strtotime($tanggal2)) ?></th>
    </tr>
    <tr>
        <th style="width: 1%;">No</th> 
        <th style="width: 2%;">Tanggal Transaksi</th> 
        <th style="width: 5%;">Nama Customer</th>   
        <th style="width: 9%;">Nama Spare Part</th>
        <th style="width: 4%;">No Seri</th>
        <th style="width: 4%;">Merk</th>
        <th style="width: 5%;">Harga Pembelian (pcs)</th>
        <th style="width: 6%;">Harga Jual (pcs)</th>
        <th style="width: 5%;">Jumlah Pembelian</th> 
        <th style="width: 6%;">Harga Total Setelah Diskon</th>
        <th style="width: 5%;">Total Laba/Rugi</th>
    </tr>
    <tbody>
    <?php
    $no = 1;
    $totalan_laba_rugi = 0;

    $filter_tanggal = "";
    if ($tanggal1 != 0 && $tanggal2 != 0) {
        $filter_tanggal = "date_format(invoice.tanggal_transaksi, '%Y-%m-%d') BETWEEN '$tanggal1' AND '$tanggal2'";
    } elseif ($tanggal1 == "" && $tanggal2 == "") {
        # code...
        $hari_ini = date('Y-m-d H:i');
        $filter_tanggal = "date_format(invoice.tanggal_transaksi, '%Y-%m-%d') BETWEEN '$hari_ini' AND '$hari_ini'";
    }

    $spare_part = "SELECT * FROM invoice 
            LEFT JOIN invoice_detail ON invoice_detail.id_invoice = invoice.id_invoice
            LEFT JOIN spare_part_stok ON spare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
            LEFT JOIN customer ON customer.id_customer = invoice.id_customer
            WHERE $filter_tanggal
            ORDER BY invoice.id_invoice DESC";

     $query_spare = Yii::$app->db->createCommand($spare_part)->query();
     foreach ($query_spare as $key => $data) {
        $ttlpcs = $data['setelah_diskon'] - ($data['harga_beli'] * $data['jumlah_transaksi']);
        $totalan_laba_rugi += $ttlpcs;

    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td style="text-align: center;"><?= date('d/m/Y', strtotime($data['tanggal_transaksi'])) ?></td>
        <td style="white-space: nowrap;"><?= $data['nama_customer'] ?></td>
        <td style="white-space: nowrap;"><?= $data['nama_spare_part'] ?></td>
        <td style="white-space: nowrap;"><?= $data['no_seri'] ?></td>
        <td style="white-space: nowrap;"><?= $data['merk_spare_part'] ?></td>
        <td align="right" style="white-space: nowrap;"><?= ribuan($data['harga_beli']) ?></td>
        <td align="right" style="white-space: nowrap;"><?= ribuan($data['harga']) ?></td>
        <td align="right" style="white-space: nowrap;"><?= ribuan($data['jumlah_transaksi']) ?></td>
        <td align="right" style="white-space: nowrap;"><?= ribuan($data['setelah_diskon']) ?></td>
        <td align="right" style="white-space: nowrap;"><?= ribuan($ttlpcs) ?></td>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="10"><center>Totalan Laba / Rugi </center></th>
            <td align="right"><strong><?= ribuan($totalan_laba_rugi) ?></strong></td>
        </tr>
    </tfoot>
</table>

<?php
$fileName = "Export Laporan Riwayat Roster Durasi Unit : " . date('d/m/Y', strtotime($tanggal1)) . " s/d " . date('d/m/Y', strtotime($tanggal2)) . ").xls";
header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/vnd.ms-excel");
?>