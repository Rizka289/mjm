<?php

namespace backend\controllers;

use Yii;
use backend\models\Invoice;
use backend\models\Customer;
use backend\models\InvoiceDetail;
use backend\models\InvoiceSearch;
use backend\models\SparePartStok;
use backend\models\Foto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class InvoiceController extends Controller
{
   
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

  
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if($model->status_tempo == 1){
                $model->status_tempo = 1;
                // $model->save(FALSE);
            }else if($model->status_tempo == 2 ){
                if(date("Y-m-d") >= $model->tanggal_tagihan ){
                    $model->status_tempo = 3;
                    $model->save(FALSE);
                }else{
                    $model->status_tempo =2;
                    $model->save(FALSE);
                }
            }else{
                $model->status_tempo = 3;
                $model->save(FALSE);
            }
        
        $dat_bel = InvoiceDetail::findOne(['id_invoice' => $id]);
        if ($dat_bel != null){
            $dat_bel1 = InvoiceDetail::find()->where(['id_invoice' => $id])->sum("setelah_diskon");
            $model->jumlah_belanja = $dat_bel1;
            $model->sisa_pembayaran = $model->jumlah_belanja - $model->dp;
            $model->save();
        }    

            $foto1   = Foto::find()->where(["id_tabel" => $model->id_invoice, "nama_tabel" => "invoice"])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'foto1' => $foto1,
        ]);
       
    }

  
    public function actionCreate()
    {
        $data_invoice = Invoice::find()->where(["year(tanggal_tagihan)"=>date("Y"), "month(tanggal_tagihan)"=>date("m")])->count();
            if ($data_invoice < 1)
            {
                $data_invoice = 1;
            }
            else
            {
                $data_invoice++;
            }

            $nomor_penerimaan = "PJ".date("ymd").str_pad($data_invoice,3,"0",STR_PAD_LEFT); 

        $model = new Invoice();

        $model->no_invoice = $nomor_penerimaan;
        $model->tanggal_transaksi = date('Y-m-d');
        $model->jumlah_belanja = 0;
        $model->dp = 0;
        $model->sisa_pembayaran = 0;

        $array_customer = customer::find()
            ->select(["nama_customer as value", "id_customer as id"])
            ->asArray()
            ->all();
        
        $selected_customer = "";
        
        if ($model->load(Yii::$app->request->post())) {
            $model->id_login = Yii::$app->user->identity->id_login;
            $model->status_tempo = 2;
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->id_invoice]);
        }
            
        return $this->render('create', [
            'model' => $model,
            'array_customer' => $array_customer,
            'selected_customer' => $selected_customer,
        ]);
    }

  
    public function actionUpdate($id)
    {
          if (Yii::$app->user->isGuest) {

			header("Location: index.php");

			exit();

		}

        $model = $this->findModel($id);
        $array_customer = customer::find()
            ->select(["nama_customer as value", "id_customer as id"])
            ->asArray()
            ->all();
        
        $selected_customer = Customer::find()->where(['id_customer' => $model->id_customer])->one();
          
        if ($model->load(Yii::$app->request->post())){
            if($model->status_tempo == 1){
                $model->status_tempo = 1;
                $model->save(FALSE);
            }else if($model->status_tempo == 2 ){
                 if(date("Y-m-d") >= $model->tanggal_tagihan ){
                    $model->status_tempo = 3;
                    $model->save(FALSE);
                }else{
                    $model->status_tempo =2;
                    $model->save(FALSE);
                }
            }else{
                $model->status_tempo = 3;
                $model->save(FALSE);
            }
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->id_invoice]);
        } 

        return $this->render('update', [
            'model' => $model,
            'array_customer' => $array_customer,
            'selected_customer' => $selected_customer,
        ]);
       
    }
    public function actionSelesai($id)
    {
        if (Yii::$app->user->isGuest) {

			header("Location: index.php");

			exit();

		}

        $model = $this->findModel($id);
        $model->status_tempo = 1;
        $model->save(FALSE);

        return $this->redirect(['view', 'id' => $model->id_invoice]);
    }
  
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $cek = Yii::$app->db->createCommand("SELECT COUNT(id_invoice) FROM invoice_detail WHERE id_invoice = '$model->id_invoice'")->queryScalar();
        $array_detail = InvoiceDetail::find()->where(['id_invoice' => $id])->all();
        foreach($array_detail as $data){
            $kurangstok = SparePartStok::findOne(['nama_spare_part' => $data->nama_spare_part, 'merk_spare_part' => $data->merk_spare_part,'no_seri' =>$data->no_seri]);
            if($kurangstok!= null){

                $kurangstok->stok = $kurangstok->stok + $data->jumlah_transaksi;
                $kurangstok->save(false);
            }
        }
        
        InvoiceDetail::deleteAll(['id_invoice' => $model->id_invoice]);
        $model->deleteAll(['id_invoice' => $model->id_invoice]);

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionUpload()
    {
       
        if (Yii::$app->user->isGuest) {
            header("Location: index.php");
            exit();
        }

        $model = new Foto();
 
        if (Yii::$app->request->isPost) {
            
            $model->nama_tabel  = Yii::$app->request->post('nama_tabel');
            $model->id_tabel    = Yii::$app->request->post('id_tabel');
            
            $model->save(false);
            return $this->redirect(['view', 'id' => Yii::$app->request->post('id_tabel')]);
        } else {
            return $this->redirect(['view', 'id' => Yii::$app->request->post('id_tabel')]);
        }
    }

     public function actionPrint($id)
    {
        $model = Invoice::findOne($id);
        $foto1   = Foto::find()->where(["id_tabel" => $model->id_invoice, "nama_tabel" => "invoice"])->all();
        return $this->renderPartial('cetak', [
            'model' => $model,
            'foto1' => $foto1,
        ]);

        $mPDF = new mPDF();
        $mPDF->showImageErrors = true;
        $mPDF->writeHTML($print);
        $mPDF->Output();
        exit();
    }
     public function actionLaporanBarangKeluar()
    {
        $array_customer = Customer::find()
            ->select(["nama_customer as value", "id_customer as id"])
            ->asArray()
            ->all();

        // var_dump($array_customer);die;
        $tanggal_awal = Yii::$app->request->post('tanggal_awal');
        $tanggal_akhir = Yii::$app->request->post('tanggal_akhir');
        $nama_customer = Yii::$app->request->post('nama_customer');

        return $this->render('laporan_barang_keluar', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'nama_customer' => $nama_customer,
            'array_customer' => $array_customer,
        ]);
    }
      public function actionCetakLaporanBarangKeluar($tanggal_awal, $tanggal_akhir, $nama_customer)
    {
        
        return $this->renderPartial('cetak_laporan_barang_keluar', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'nama_customer' => $nama_customer,
          
        ]);
    }
      public function actionExportLaporanBarangKeluar($tanggal_awal, $tanggal_akhir, $nama_customer)
    {
        return $this->renderPartial('export_laporan_barang_keluar', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'nama_customer' => $nama_customer,
          
        ]);
    }
}
