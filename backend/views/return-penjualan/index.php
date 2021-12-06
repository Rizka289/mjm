<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use yii\widgets\DetailView;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

use backend\models\NamaSparePart;
use backend\models\MerkSparePart;
use yii\web\UploadedFile;

$this->title = 'Laporan Return Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="return-penjualan-index">
	<h4>Laporan Return Penjualan</h4>
    <div class="return-penjualan-view">
        <div class="box">
            <div class="box-header">
                <div class="col-md-12" style="padding: 0;">
                    <div class="box-body">
                    	<table class='table table-sm table-striped'>
                        	<thead>
                        		<tr class="info">
					                <th>No</th>
					                <th>No Transaksi</br>Penjualan</th>
					                <th>Nama Customer</th>
					                <th>Tanggal Transaksi</th>
					                <th>Nama Spare Part</th>
					                <th>Merk Spare Part</th>
					                <th>Jumlah</th>
					                <th>Nomor Seri</th>
					                <th>Harga Akhir</th>
					                <th>Keterangan Return</th>
					                <th>Foto</th>
					            </tr>
                        		<?php
                        			$no = 1;
                        			$return = "SELECT * FROM return_penjualan 
                                        LEFT JOIN invoice ON invoice.id_invoice = return_penjualan.id_invoice
                                        LEFT JOIN customer ON customer.id_customer = invoice.id_customer
                                        LEFT JOIN invoice_detail on invoice_detail.id_invoice = invoice.id_invoice 
                                        -- LEFT JOIN spare_part_stok on spaare_part_stok.id_spare_part_stok = invoice_detail.id_spare_part_stok
                                        ";

	                                $query_return = Yii::$app->db->createCommand($return)->query();
	                                foreach ($query_return as $key => $data) {
	                                	$spare_part = NamaSparePart::findOne(['nama_spare_part' => $data['nama_spare_part']]);
	                                	$merk = MerkSparePart::findOne(['nama_merk'=>$data['merk_spare_part']]);
                        		?>
                        	</thead>
                        	<tbody>
								<tr>
					                <td><?= $no++ ?></td>
					                <td><?= $data['no_invoice'] ?></td>
					                <td><?= $data['nama_customer'] ?></td>
					                <td><?= Yii::$app->formatter->asDate($data['tanggal_transaksi']) ?></td>
					                <td><?= $data['nama_spare_part'] ?></td>
					                <td><?= $data['merk_spare_part'] ?></td>
					                <td><?= $data['jumlah'] ?></td>
					                <td><?= $data['no_seri'] ?></td>
					                <td><?= 'Rp.' . ribuan($data['harga']) ?></td>
					                <td><?= $data['keterangan_return'] ?></td>
						            <td>
						            	<?php
												echo "<img src='upload/$data[foto]' width='150'>";
										?>
									</td>    
					            </tr>
					            <?php } ?>
                        	</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>