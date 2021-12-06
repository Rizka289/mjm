<?php

namespace backend\controllers;

use Yii;
use backend\models\SparePart;
use backend\models\SparePartDetail;
use backend\models\SparePartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\Supplier;
use backend\models\Uom;
use backend\models\Foto;


class SparePartController extends Controller
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
        $searchModel = new SparePartSearch();
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
                if(date("Y-m-d") >= $model->tanggal_jatuh_tempo ){
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
            $foto1   = Foto::find()->where(["id_tabel" => $model->id_spare_part, "nama_tabel" => "spare_part"])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'foto1' => $foto1,
        ]);
    }

 
    public function actionCreate()
    {
        $data_masuk = SparePart::find()->where(["year(tanggal_masuk)"=>date("Y"), "month(tanggal_masuk)"=>date("m")])->count();
            if ($data_masuk < 1)
            {
                $data_masuk = 1;
            }
            else
            {
                $data_masuk++;
            }

            $nomor_penerimaan = "PB".date("ymd").str_pad($data_masuk,3,"0",STR_PAD_LEFT); 

        $model = new SparePart();
        $model->jumlah_belanja = 0;
        $model->dp = 0;
        $model->no_nota_masuk = $nomor_penerimaan;
        // $model->status_tempo = 1;
        $model->tanggal_masuk = date('Y-m-d');

        
        $array_supplier = Supplier::find()
            ->select(["nama_supplier as value", "id_supplier as id"])
            ->asArray()
            ->all();
        
        $selected_supplier = "";
       
        if ($model->load(Yii::$app->request->post())){
            $model->id_login = Yii::$app->user->identity->id_login;
            $model->sisa_pembayaran = $model->jumlah_belanja - $model->dp;
            $model->status_tempo = 2;
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->id_spare_part]);
        } 

        return $this->render('create', [
            'model' => $model,
            'array_supplier' => $array_supplier,
            'selected_supplier' => $selected_supplier,
        ]);
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


    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {

			header("Location: index.php");

			exit();

		}

        $model = $this->findModel($id);
        $array_supplier = Supplier::find()
            ->select(["nama_supplier as value", "id_supplier as id"])
            ->asArray()
            ->all();
        
        $selected_supplier = Supplier::find()->where(['id_supplier' => $model->id_supplier])->one();
          
        if ($model->load(Yii::$app->request->post())){
            $model->sisa_pembayaran = $model->jumlah_belanja - $model->dp;
            if($model->status_tempo == 1){
                $model->status_tempo = 1;
                $model->save(FALSE);
            }else if($model->status_tempo == 2 ){
                 if(date("Y-m-d") >= $model->tanggal_jatuh_tempo ){
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
            return $this->redirect(['view', 'id' => $model->id_spare_part]);
        } 

        return $this->render('update', [
            'model' => $model,
            'array_supplier' => $array_supplier,
            'selected_supplier' => $selected_supplier,
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

        return $this->redirect(['view', 'id' => $model->id_spare_part]);
    }

       public function actionPrint($id)
    {

        $model = SparePart::findOne($id);
        $foto1   = Foto::find()->where(["id_tabel" => $model->id_spare_part, "nama_tabel" => "spare_part"])->all();
        return $this->renderPartial('cetak', [
            'model' => $model,
            'foto1' => $foto1,
        ]);

        $mPDF = new mPDF(['orientation' => 'L']);
        $mPDF->showImageErrors = true;
        $mPDF->writeHTML($print);
        $mPDF->Output();
        exit();
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $cek = Yii::$app->db->createCommand("SELECT COUNT(id_spare_part) FROM spare_part_detail WHERE id_spare_part = '$model->id_spare_part'")->queryScalar();
        SparePartDetail::deleteAll(['id_spare_part' => $model->id_spare_part]);
        $model->deleteAll(['id_spare_part' => $model->id_spare_part]);
        
        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = SparePart::findOne($id)) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionLaporanBarangMasuk()
   {
       $array_supplier = Supplier::find()
           ->select(["nama_supplier as value", "id_supplier as id"])
           ->asArray()
           ->all();

       // var_dump($array_customer);die;
       $tanggal_awal = Yii::$app->request->post('tanggal_awal');
       $tanggal_akhir = Yii::$app->request->post('tanggal_akhir');
       $nama_supplier = Yii::$app->request->post('nama_supplier');

       return $this->render('laporan_barang_masuk', [
           'tanggal_awal' => $tanggal_awal,
           'tanggal_akhir' => $tanggal_akhir,
           'nama_supplier' => $nama_supplier,
           'array_supplier' => $array_supplier,
       ]);
   }
    public function actionCetakBarangMasuk($tanggal_awal,$tanggal_akhir,$nama_supplier)
   {
       return $this->render('cetak_laporan_barang_masuk', [
           'tanggal_awal' => $tanggal_awal,
           'tanggal_akhir' => $tanggal_akhir,
           'nama_supplier' => $nama_supplier,
       ]);
   }
    public function actionExportLaporanBarangMasuk($tanggal_awal, $tanggal_akhir, $nama_supplier)
    {
        return $this->renderPartial('export_laporan_barang_masuk', [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'nama_supplier' => $nama_supplier,
          
        ]);
    }

 

}
