<?php

namespace backend\controllers;

use Yii;
use backend\models\Karyawan;
use backend\models\KaryawanSearch;
use backend\models\Foto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class KaryawanController extends Controller
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
        $searchModel = new KaryawanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
			header("Location: index.php");
			exit();
		}
        
        if (!empty(Yii::$app->request->get('id_hapus')))
        {
            Foto::deleteAll(["id_foto"=>Yii::$app->request->get('id_hapus')]);        
        }

        $foto = Foto::find()->where(["id_tabel"=>$id, "nama_tabel"=>"karyawan"])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'foto' => $foto,
        ]);
    }


    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            header("Location: index.php");
            exit();
		}
        $model = new Karyawan();

         if ($model->load(Yii::$app->request->post())) {
            $cek = Karyawan::findOne(['nik' => $model->nik]);
            if ($cek != null){
                Yii::$app->session->setFlash('danger', 'Nomor Induk Kependudukan (NIK) Sudah Ada Pada Data Sebelumnya Dengan Nama : ' . $cek->nama);
                return $this->redirect(['create']);
            } else {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_karyawan]);
            }
        }

        return $this->render('create', [
            'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_karyawan]);
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
        if (($model = Karyawan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
