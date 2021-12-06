<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Arrayhelper;
use yii\widgets\DetailView;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

use kartik\daterange\DateRangePicker;
use kartik\datetime\DateTimePicker;

$this->title = 'Laporan Laba Rugi';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
?>
<div class="laba-rugi-index">
    <h4><?= Html::encode($this->title) ?></h4>
        <div class="box">
            <div class="box-header">
                <div class="col-md-12" style="padding: 0;">
                    <div class="box-body">
                        <div>
                            <?= Html::beginForm(['index', array('class' => 'form-inline')]) ?>

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
                                            <?= DateTimePicker::widget([
                                            'name' => 'tanggal1',
                                            'options' => ['placeholder' => 'Tanggal Awal', 'autocomplete' => 'off', 'required' => true],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'todayBtn' => true,
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd',
                                                'defaultDate' => 'tanggal1',
                                                ]
                                            ]) ?>
                                        </div>
                                    </td>
                                    <td width="5%">
                                     <td width="10%">
                                        <div class="form-group"></div>
                                    </td>
                                    <td align="center" width="5%">
                                        <div class="form-group"></div>
                                    </td>
                                    <td width="30%">
                                        <div class="form-group">
                                            
                                        </div>
                                    </td>
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
                                            <?= DateTimePicker::widget([
                                            'name' => 'tanggal2',
                                            'options' => ['placeholder' => 'Tanggal Akhir', 'autocomplete' => 'off', 'required' => true],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'todayBtn' => true,
                                                'todayHighlight' => true,
                                                'format' => 'yyyy-mm-dd',
                                                'defaultDate' => 'tanggal2',
                                                ]
                                            ]) ?>
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
                                            $tanggal1_ = ($tanggal1 == "") ? date('Y-m-d') : $tanggal1;
                                            $tanggal2_ = ($tanggal2 == "") ? date('Y-m-d') : $tanggal2;
                                            ?>
                                            <?= Html::a(
                                                'Export Laporan',
                                                [
                                                    'export-laba-rugi',
                                                    'tanggal1' => $tanggal1_,
                                                    'tanggal2' => $tanggal2_,
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
            .table th{
                padding: 3px;
            }
        </style>
        <p style="font-family: 'Times New Roman'">
            <h4>Laporan Laba Rugi</h4>
            <table class="tabel">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>: <?= ($tanggal1 != '') ? date('d/m/Y', strtotime($tanggal1)) : date('d/m/Y'); ?> s/d <?= ($tanggal2 != '') ? date('d/m/Y', strtotime($tanggal2)) : date('d/m/Y'); ?></th>
                    </tr>
                </thead>
            </table>
        </p>
        <div class="box">
            <div class="box-header">
                <div class="col-md-12" style="padding: 0;">
                    <div class="box-body">

                        <table class="table table-bordered table-condensed table-hover">
                        	<thead>
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
                            </thead>
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
                                	// $id_spare = NamaSparePart::find()->where(['nama_spare_part' => $data['nama_spare_part']])->andWhere(['nama_spare_part' => $data['nama_spare_part']])->one();
                                	// $id_merk = MerkSparePart::findOne(['nama_merk' => $data['merk_spare_part']]);
                                	// $spare_det = SparePartDetail::find()->where(['nama_spare_part' => $data['nama_spare_part']])->andWhere(['nama_spare_part' => $data['nama_spare_part']])->one();
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
                    </div>
                </div>
            </div>
        </div>
</div>
