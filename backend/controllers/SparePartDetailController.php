<?php

namespace backend\controllers;

use Yii;
use backend\models\SparePartDetail;
use backend\models\MerkSparePart;
use backend\models\NamaSparePart;
use backend\models\SparePartStok;
use backend\models\SparePart;
use backend\models\SparePartDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SparePartDetailController extends Controller
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
        $searchModel = new SparePartDetailSearch();
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
        $model = new SparePartDetail();
        $model->status_stok = 0;

        $array_nama_spare_part = NamaSparePart::find()
            ->select(["concat(nama_spare_part, ', Nomor Seri  / Type : ', no_seri) as value", "id_nama_spare_part as id"])
           ->orderBy("value")
            ->asArray()
            ->all();
        $array_merk_spare_part = MerkSparePart::find()
            ->select(["nama_merk as value", "id_merk as id"])
            ->asArray()
            ->all();
        
        $selected_nama_spare_part = "";
        $selected_merk_spare_part = "";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['spare-part/view', 'id' => $model->id_spare_part]);
        }

        return $this->render('create', [
            'model' => $model,
            'array_nama_spare_part' => $array_nama_spare_part,
            'array_merk_spare_part' => $array_merk_spare_part,
            'selected_nama_spare_part' => $selected_nama_spare_part,
            'selected_merk_spare_part' => $selected_merk_spare_part,
        ]);
    }


    public function actionUpdate($id, $id_spare_part)
    {
        $model = $this->findModel($id);

         $array_nama_spare_part = NamaSparePart::find()
            ->select(["concat(nama_spare_part, ', Nomor Seri  / Type : ', no_seri) as value", "id_nama_spare_part as id"])
           ->orderBy("value")
            ->asArray()
            ->all();
        $array_merk_spare_part = MerkSparePart::find()
            ->select(["nama_merk as value", "id_merk as id"])
            ->asArray()
            ->all();
        $selected_nama_spare_part = NamaSparePart::find()->where(['id_nama_spare_part' => $model->id_nama_spare_part])->one();
        $selected_merk_spare_part = MerkSparePart::find()->where(['id_merk' => $model->id_merk_spare_part])->one();
       

        if ($model->load(Yii::$app->request->post())) {
            $model->id_spare_part = $id_spare_part;
            if($model->save())
                return $this->redirect(['spare-part/view', 'id' => $id_spare_part ]);
        }

        return $this->render('update', [
            'model' => $model,
            'array_nama_spare_part' => $array_nama_spare_part,
            'array_merk_spare_part' => $array_merk_spare_part,
            'selected_nama_spare_part' => $selected_nama_spare_part,
            'selected_merk_spare_part' => $selected_merk_spare_part,
        ]);
        
    }

 

    public function actionStok($id, $id_spare_part)
    {

        $array_detail = SparePartDetail::findOne(['id_spare_part_detail' => $id, 'id_spare_part' => $id_spare_part]);
        $spare_part = NamaSparePart::findOne(['id_nama_spare_part' => $array_detail->id_nama_spare_part]);
        $merk_spare_part = MerkSparePart::findOne(['id_merk' => $array_detail->id_merk_spare_part]);
            
        $masukstok = SparePartStok::findOne(['nama_spare_part' => $spare_part->nama_spare_part, 'merk_spare_part' => $merk_spare_part->nama_merk, 'no_seri' =>$spare_part->no_seri ,'nama_rak' =>$spare_part->nama_rak]);
            if ($masukstok != null){
                $masukstok->stok = $masukstok->stok + $array_detail->jumlah;
                $masukstok->harga = $array_detail->harga_jual;
                $masukstok->harga_beli = $array_detail->harga_beli;
                $masukstok->save(FALSE);
            } else {
                $stok = new SparePartStok;
                $stok->nama_spare_part = $spare_part->nama_spare_part;
                $stok->nama_rak = $spare_part->nama_rak;
                $stok->no_seri = $spare_part->no_seri;
                $stok->merk_spare_part =  $merk_spare_part->nama_merk;
                $stok->stok = $array_detail->jumlah;
                $stok->harga = $array_detail->harga_jual;
                $stok->harga_beli = $array_detail->harga_beli;
                $stok->save(FALSE);
            }

        $array_detail->status_stok = 1;
        $array_detail->save(false);
         
        return $this->redirect(['spare-part/view', 'id' => $id_spare_part]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_spare_part         = $_GET['id_spare_part'];


        $this->findModel($id)->delete();

        return $this->redirect(['spare-part/view', 'id' => $id_spare_part]);
    }

    public function actionDeleteStok($id, $id_spare_part)
    {

        $array_detail = SparePartDetail::findOne(['id_spare_part_detail' => $id, 'id_spare_part' => $id_spare_part]);
        $spare_part = NamaSparePart::findOne(['id_nama_spare_part' => $array_detail->id_nama_spare_part]);
        $merk_spare_part = MerkSparePart::findOne(['id_merk' => $array_detail->id_merk_spare_part]);
            
        $kurangistok = SparePartStok::findOne(['nama_spare_part' => $spare_part->nama_spare_part, 'merk_spare_part' => $merk_spare_part->nama_merk, 'no_seri' =>$spare_part->no_seri ,'nama_rak' =>$spare_part->nama_rak]);
            $kurangistok->stok = $kurangistok->stok - $array_detail->jumlah;
            $kurangistok->harga = $array_detail->harga_jual;
            $kurangistok->harga_beli = $array_detail->harga_beli;
            $kurangistok->save(FALSE);

        $this->findModel($id)->delete();

        return $this->redirect(['spare-part/view', 'id' => $id_spare_part]);
    }

    protected function findModel($id)
    {
        if (($model = SparePartDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
