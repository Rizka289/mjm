<?php

namespace backend\controllers;

use Yii;
use backend\models\NamaSparePart;
use backend\models\Rak;
use backend\models\NamaSparePartSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class NamaSparePartController extends Controller
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
        $searchModel = new NamaSparePartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination->pageSize=7;

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
        $model = new NamaSparePart();
        $array_rak = Rak::find()
            ->select(["nama_rak as value", "nama_rak as id"])
            ->asArray()
            ->all();

        $selected_rak = "";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_nama_spare_part]);
        }

        return $this->render('create', [
            'model' => $model,
            'array_rak' => $array_rak,
            'selected_rak' => $selected_rak,
        ]);
    }

 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $array_rak = Rak::find()
            ->select(["nama_rak as value", "nama_rak as id"])
            ->asArray()
            ->all();

        $selected_rak = Rak::find()->where(['nama_rak' => $model->nama_rak])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_nama_spare_part]);
        }

        return $this->render('update', [
            'model' => $model,
            'array_rak' => $array_rak,
            'selected_rak' => $selected_rak,
        ]);
    }

   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = NamaSparePart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
