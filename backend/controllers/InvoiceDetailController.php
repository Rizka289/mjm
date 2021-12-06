<?php

namespace backend\controllers;

use Yii;
use backend\models\InvoiceDetail;
use backend\models\SparePartStok;
use backend\models\InvoiceDetailSearch;
use backend\models\ReturnPenjualan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class InvoiceDetailController extends Controller
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
        $searchModel = new InvoiceDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

 
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

 
    public function actionCreate()
    {
        $model = new InvoiceDetail();
        $model->jumlah_transaksi = 0;
        $model->diskon = 0;
        $model->diskon_persen = 0;

        $array_spare_part_stok = SparePartStok::find()
            ->select(["concat(nama_spare_part, ', Nomor Seri  / Type : ', no_seri,', Merk : ', merk_spare_part,', Harga Jual : ', harga ,', Qty : ',stok) as value", "id_spare_part_stok as id"])
            ->orderBy("value")
            ->asArray()
            ->all();
            
        $selected_array_spare_part_stok = "";
       if ($model->load(Yii::$app->request->post())) {
            $spare_part_stok = SparePartStok::find()
			->where(['id_spare_part_stok' => $model->id_spare_part_stok])
			->andWhere(['>=','stok',$model->jumlah_transaksi])
			->one();
           
           if ($spare_part_stok) {
                $spare_part_stok->stok = $spare_part_stok->stok - $model->jumlah_transaksi;
                $spare_part_stok->save(FALSE);
            } else {
                Yii::$app->session->setFlash('danger','Jumlah Penggunaan melebihi stok spare part.');
                return $this->render('create', [
					'model' => $model,
                    'array_spare_part_stok' => $array_spare_part_stok,
                    'selected_array_spare_part_stok' => $selected_array_spare_part_stok,
				
				]);
            }
            $model->nama_spare_part = $spare_part_stok->nama_spare_part;
            $model->no_seri = $spare_part_stok->no_seri;
            $model->harga_jual = $spare_part_stok->harga;
            $model->merk_spare_part = $spare_part_stok->merk_spare_part;
            $sub_total_1 = $model->jumlah_transaksi * $spare_part_stok['harga'] - $model->diskon;
            $sub_total_2_ = ($model->jumlah_transaksi * $spare_part_stok['harga'] * $model->diskon_persen) / 100;
            $sub_total_2 = ($model->jumlah_transaksi * $spare_part_stok['harga']) - $sub_total_2_;
            $sub_total_3 = ($model->diskon == 0) ? $sub_total_2 : $sub_total_1 ;
            $model->setelah_diskon = $sub_total_3;
            $model->save(FALSE);
           return $this->redirect(['invoice/view', 'id' => $model->id_invoice]);
        }

        return $this->render('create', [
            'model' => $model,
            'array_spare_part_stok' => $array_spare_part_stok,
            'selected_array_spare_part_stok' => $selected_array_spare_part_stok,
        ]);
    }

 
    public function actionUpdate($id,$id_invoice)
    {
        $model = $this->findModel($id);
        // var_dump($id_invoice);die;

        $array_spare_part_stok = SparePartStok::find()
            ->select(["concat(nama_spare_part, ', Nomor Seri  / Type : ', no_seri,', Merk : ', merk_spare_part,', Harga Jual : ', harga ,', Qty : ',stok) as value", "id_spare_part_stok as id"])
            ->orderBy("value")
            ->asArray()
            ->all();
            
        $selected_array_spare_part_stok  = SparePartStok::find()->where(['id_spare_part_stok' => $model->id_spare_part_stok])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_invoice = $id_invoice;
            if($model->save())
            return $this->redirect(['invoice/view', 'id' => $id_invoice]);
        }

        return $this->render('update', [
            'model' => $model,
            'array_spare_part_stok' => $array_spare_part_stok,
            'selected_array_spare_part_stok' => $selected_array_spare_part_stok,
        ]);
    }

 
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_invoice         = $_GET['id_invoice'];

        // $kurangstok = SparePartStok::find()->where(["id_spare_part_stok" => $model->id_spare_part_stok])->orderBy("id_spare_part_stok desc")->one();
        $kurangstok = SparePartStok::findOne(['nama_spare_part' => $model->nama_spare_part, 'merk_spare_part' => $model->merk_spare_part,'no_seri' =>$model->no_seri]);
        $kurangstok->stok = $kurangstok->stok + $model->jumlah_transaksi;
        $kurangstok->save(false);

        $this->findModel($id)->delete();

        return $this->redirect(['invoice/view', 'id' => $id_invoice ]);
    }

    public function actionReturnPenjualan($id, $id_invoice)
    {
        $model = new ReturnPenjualan();

        if ($model->load(Yii::$app->request->post())  ) {
            $inv_det = InvoiceDetail::findOne([$id]);
            
            $model->id_invoice = $_GET['id_invoice'];
            $model->nama_spare_part = $inv_det->nama_spare_part;
            $model->no_seri = $inv_det->no_seri;
            $model->merk_spare_part = $inv_det->merk_spare_part;
            // $model->jumlah = $inv_det->jumlah_transaksi;
            $model->harga = $model->jumlah * $inv_det->harga_jual;

            $model->foto = UploadedFile::getInstance($model, 'foto');
            // var_dump( UploadedFile::getInstance($model, 'foto')); die;
            $model->save(false);

            $kurangstok = SparePartStok::findOne(['nama_spare_part' => $model->nama_spare_part, 'merk_spare_part' => $model->merk_spare_part,'no_seri' =>$model->no_seri]);
            // $kurangstok->stok = $kurangstok->stok + $inv_det->jumlah_transaksi;
            $kurangstok->stok = $kurangstok->stok + $model->jumlah;
            $kurangstok->save(false);
    
            $sisa_return = InvoiceDetail::findOne(['nama_spare_part' => $model->nama_spare_part, 'merk_spare_part' => $model->merk_spare_part,'no_seri' =>$model->no_seri]);
            $sisa_return->jumlah_transaksi = $sisa_return->jumlah_transaksi - $model->jumlah;
            $sub_total_1 = $sisa_return->jumlah_transaksi * $kurangstok->harga - $sisa_return->diskon;
            $sub_total_2_ = ($sisa_return->jumlah_transaksi * $kurangstok->harga * $sisa_return->diskon_persen) / 100;
            $sub_total_2 = ($sisa_return->jumlah_transaksi * $kurangstok->harga) - $sub_total_2_;
            $sub_total_3 = ($sisa_return->diskon == 0) ? $sub_total_2 : $sub_total_1 ;
            $sisa_return->setelah_diskon = $sub_total_3;
            $sisa_return->save(false);

            if(($sisa_return->jumlah_transaksi) == 0){
                $this->findModel($id)->delete();
            }
            return $this->redirect(['invoice/view', 'id' => $id_invoice ]);
        }

        return $this->render('return', [
            'model' => $model,
        ]);

    }

    protected function findModel($id)
    {
        if (($model = InvoiceDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
