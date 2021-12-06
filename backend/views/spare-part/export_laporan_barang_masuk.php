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
        <th colspan="12">Laporan Spare Part Masuk / Pembelian Pertanggal : <?= date('d/m/Y', strtotime($tanggal_awal)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></th>
    </tr>
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
    <tr>
      
                                <th colspan="10">Total</th>
                                <td align="right"><strong><?= ribuan($totalan_harga_spare_part) ?></strong></td>
                            
    </tr>
</table>
<?php
$fileName = "Export Laporan Barang Masuk : " . date('d/m/Y', strtotime($tanggal_awal)) . " s/d " . date('d/m/Y', strtotime($tanggal_akhir)) . ").xls";
header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/vnd.ms-excel");
?>