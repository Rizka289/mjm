<?php

namespace backend\controllers;

use Yii;
use backend\models\Supplier;
use backend\models\SupplierSearch;
use backend\models\Foto;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SupplierController extends Controller
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
        $searchModel = new SupplierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=7;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

  
    public function actionView($id)
    {
       $model = $this->findModel($id);

        if (!empty(Yii::$app->request->get('id_hapus')))
        {
            Foto::deleteAll(["id_foto"=>Yii::$app->request->get('id_hapus')]);        
        }

        $foto1   = Foto::find()->where(["id_tabel" => $model->id_supplier, "nama_tabel" => "supplier"])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'foto1' => $foto1,
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

    public function actionCreate()
    {
        $model = new Supplier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_supplier]);
        }
     
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_supplier]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
