<?php
use backend\models\Login;
?>
<style>
.table {
  border-collapse: collapse;
  border: 1px solid #000000;
  width: 100%;
  font-size: 12px;
  margin-top: 0px;
}

.table th, .table td {
  padding: 3px;
  font-family: 'Calibri';
}
.tabela {
	border-collapse: collapse;
	border: 1px;
	border-color: #3CB371;
    margin-top: 10px;
}
</style>
<body onload="window.print()">
<table border="0" width="100%" style="font-size: 12px;">
    <tr>
        <th rowspan="7">
            <img class="img" src="images/logo.jpg" style="width: 75px;">
        </th>
        <th rowspan="7" align="left">
            <strong style="font-size: 15px; color: #2F4F4F; font-family: 'Calibri';">Sentra Grosir </br>"MESIN JAHIT MURAH"</strong><br>
            Brother, Juki, Typical, Singer, Butterfly, <br> Bordir Komputer, dll.<br>
            JL.Kakap N0.59 (Komplek Pergudangan)<br>
            Telp.(024) 3575942, WA.082325318544 <br>
            Website : www.mesinjahitmurah.com
        </th>
        <th align="left">NOTA PENJUALAN</th>
        <th align="left"> : <?= $model->no_invoice; ?></th>
    </tr>
    <tr>
        <th align="left">NAMA CUSTOMER</th>
        <th align="left"> : <?= $model->customer->nama_customer ?></th>
    <tr>
   <tr>
        <th align="left">JENIS PEMBAYARAN</th>
        <th align="left"> :  <?php if ($model->jns_pembayaran == 1) {
                        echo " Cash";
                    }else {
                        echo "Kredit";
                    } ?></th>
    </tr>
   <tr>
        <th align="left">KETERANGAN</th>
        <th align="left"> :  <?= $model->keterangan?></th>
    </tr>
    <tr>
        <th align="left">DIBUAT OLEH</th>
        <th align="left"> : <?= $model->login->nama  ?></th>
    </tr>
    <tr style="background-color: #1E90FF;">
        <th colspan="4" align="left" style="color: #FFFFFF">
        	<strong>
        		<h2 style="font-family: 'Calibri'; font-size:10px">
	        		TANGGAL TRANSAKSI :
		            <?= tanggal_indo(date('d M Y', strtotime($model->tanggal_transaksi))) ?>
	        	</h2>
        	</strong>
        </th>
    </tr>
</table><br>
<table class="table" border="1">
    <tr>
        <th>No</th>
        <th>Nama Spare Part</th>
        <th>Merk Spare Part</th>
        <th>Nomor Seri</th>
        <th>Jumlah</th>
        <th>Harga Jual</th>
        <th>Sub Total</th>
        <th>Diskon</th>
        <th>Diskon Persen</th>
        <th>Setelah Diskon</th>
    </tr>
  <tbody>
            <?php
            $no = 1;
            $total_harga = 0;$total_diskon = 0;
            $query    = Yii::$app->db->createCommand("SELECT * FROM invoice_detail
                LEFT JOIN spare_part_stok ON spare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
                WHERE id_invoice = '$model->id_invoice'")->query();
            foreach ($query as $key => $value) { ?>
            <?php
              $total_hargaa = $value['jumlah_transaksi'] * $value['harga'];
              $total_harga += $total_hargaa;
              $total_diskon += $value['setelah_diskon']; 
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
                <td><?= $value['diskon_persen'] ?></td>
                <td><?= 'Rp.' . ribuan($value['setelah_diskon']) ?></td>
            </tr>
            <?php } ?>
        </tbody>
         <tr>
            <th colspan="6" align="left">Total</th>
            <th style="text-align: left;"><?='Rp.' .ribuan($total_harga) ?></th>
            <th colspan="2"></th>
            <th style="text-align: left;"><?='Rp. ' . ribuan($total_diskon) ?></th>
        </tr>
</table>
 <br>
    <br>
  <table class="table" border="1">
     <tr>
        <th>LIST FOTO </th>
                </tr>
        <td><?php
            foreach ($foto1 as $data1) {
                   echo " <img src='/mjm/backend/web/upload/".$data1->foto."' width='150'> ";
            }

        ?></td>
 </table>
 <br>
 <br>
    <table>
     <tr>
		<th><p style="text-align: center;font-size: 12px;"></p>

			<p style="margin-top: 50px;text-align: center;"></p>
		</th>
		<td>
            <?php 
	    	$id_log = Yii::$app->user->id;
	    	$login = Login::findOne(['id_login' => $id_log]);
	        ?>
            <p style="text-align: center;font-size: 12px;font-weight: bold;">DICETAK OLEH</p>
			<p style="margin-top: 60px;text-align: center;font-weight: bold"><?=$login->nama?></p>
		</td>
	</tr>
 </table>