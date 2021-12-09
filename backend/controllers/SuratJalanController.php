<?php

namespace backend\controllers;

use Yii;
use backend\models\SuratJalan;
use backend\models\Kota;
use backend\models\Unit;
use backend\models\Karyawan;
use backend\models\SuratJalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SuratJalanController extends Controller
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
        $searchModel = new SuratJalanSearch();
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
        $model = new SuratJalan();

        $model->tanggal_pengiriman = date('Y-m-d');

        $array_kota = kota::find()
            ->select(["kota as value", "id as id"])
            ->asArray()
            ->all();
        $array_unit = unit::find()
            ->select(["nopol as value", "id_unit as id"])
            ->asArray()
            ->all();
        $array_karyawan = karyawan::find()
            ->select(["nama as value", "id_karyawan as id"])
            ->asArray()
            ->all();
        $selected_kota = "";
        $selected_unit = "";
        $selected_karyawan = "";

        if ($model->load(Yii::$app->request->post())) {
            $model->id_login = Yii::$app->user->identity->id_login;
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'array_kota' => $array_kota,
            'selected_kota' => $selected_kota,
            'array_unit' => $array_unit,
            'selected_unit' => $selected_unit,
            'array_karyawan' => $array_karyawan,
            'selected_karyawan' => $selected_karyawan,
        ]);
    }

 
    public function actionUpdate($id)
    {
         if (Yii::$app->user->isGuest) {

			header("Location: index.php");

			exit();

		}
        $model = $this->findModel($id);
        $array_kota = kota::find()
            ->select(["kota as value", "id as id"])
            ->asArray()
            ->all();
        $array_unit = unit::find()
            ->select(["nopol as value", "id_unit as id"])
            ->asArray()
            ->all();
        $array_karyawan = karyawan::find()
            ->select(["nama as value", "id_karyawan as id"])
            ->asArray()
            ->all();
        
         $selected_kota = Kota::find()->where(['id' => $model->id_kota])->one();
         $selected_unit = Unit::find()->where(['id_unit' => $model->id_unit])->one();
         $selected_karyawan = Karyawan::find()->where(['id_karyawan' => $model->id_karyawan])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->save(FALSE);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'array_kota' => $array_kota,
            'selected_kota' => $selected_kota,
            'array_unit' => $array_unit,
            'selected_unit' => $selected_unit,
            'array_karyawan' => $array_karyawan,
            'selected_karyawan' => $selected_karyawan,
        ]);
    }

 
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = SuratJalan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
