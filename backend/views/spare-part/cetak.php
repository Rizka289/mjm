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
        <th align="left">NOTA MASUK</th>
        <th align="left"> : <?= $model->no_nota_masuk; ?></th>
    </tr>
    <tr>
        <th align="left">NOTA SUPPLIER</th>
        <th align="left"> : <?= $model->no_nota_supplier?></th>
    </tr>
    <tr>
        <th align="left">NAMA SUPPLIER</th>
        <th align="left"> : <?php  if (!empty($model->supplier)) {
                        echo $model->supplier->nama_supplier;
                    } else {
                        echo "Data Supplier Sudah Hapus";
                    } ?></th>
    </tr>
    <tr>
        <th align="left">DOWN PAYMENET</th>
        <th align="left"> : <?= 'Rp. ' .ribuan($model->dp) ?></th>
    </tr>
    <tr>
        <th align="left">JUMLAH BELANJA</th>
        <th align="left"> : <?= 'Rp. '. ribuan($model->jumlah_belanja)  ?></th>
    </tr>
    <tr>
        <th align="left">DIBUAT OLEH</th>
        <th align="left"> : <?= $model->login->nama  ?></th>
    </tr>
  
    <tr style="background-color: #1E90FF;">
        <th colspan="4" align="left" style="color: #FFFFFF">
        	<strong>
        		<h2 style="font-family: 'Calibri'; font-size:10px">
	        		TANGGAL PENGINPUTAN :
		            <?= tanggal_indo(date('d M Y', strtotime($model->tanggal_masuk))) ?>
	        	</h2>
        	</strong>
        </th>
    </tr>
</table>
<table class="table" border="1">
    <tr>
        <th>No</th>
        <th>Nama Spare Part</th>
        <th>Merk Spare Part</th>
        <th>Nomor Seri</th>
        <th>Jumlah</th>
        <th>Harga Beli</th>
        <th>Sub Total</th>
        <th>Harga Jual</th>
        <th>Lokasi Spare Part</th>
    </tr>
    <tbody>
	    <?php
	            $no = 1;
	           $total_harga = 0;
	            $query    = Yii::$app->db->createCommand("SELECT * FROM spare_part_detail
	                LEFT JOIN nama_spare_part ON nama_spare_part.id_nama_spare_part = spare_part_detail.id_nama_spare_part
	                LEFT JOIN merk_spare_part ON merk_spare_part.id_merk = spare_part_detail.id_merk_spare_part
	                WHERE id_spare_part = '$model->id_spare_part'")->query();
	            foreach ($query as $key => $value) { 
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
	                <td><?= $value['nama_rak'] ?></td>
	            </tr>
	            <?php } ?>

	        </tbody>
        <tr>
            <th colspan="6">Total</th>
            <th style="text-align: left;"><?='Rp. ' . ribuan($total_harga) ?></th>
        </tr>
        <br>
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
  <table class="table" border="1">
     <tr>
		<th><p style="text-align: center;font-size: 12px;">DISETUJUI, <br> MANAGER MESIN JAHIT MURAH</p>

			<p style="margin-top: 50px;text-align: center;">(Bpk. IBRAHIM)</p>
		</th>
		<td>
               <?php 
	    	$id_log = Yii::$app->user->id;
	    	$login = Login::findOne(['id_login' => $id_log]);
	    ?>
            <p style="text-align: center;font-size: 12px;font-weight: bold;">DICETAK OLEH</p>
			<p style="margin-top: 60px;text-align: center;font-weight: bold"><?= $login->nama;?></p>
		</td>
	</tr>
 </table>