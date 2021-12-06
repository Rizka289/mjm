<?php

namespace backend\controllers;

use Yii;
use backend\models\Systemrole;
use backend\models\Userrole;
use backend\models\SystemroleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SystemroleController extends Controller
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
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }
        
        $searchModel = new SystemroleSearch();
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
            exit;
        }
		
		$userrole = Userrole::find()
			->joinWith("login")
			->where(["id_system_role"=>$id])
			->orderBy("login.nama")->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'userrole' => $userrole,
        ]);
    }

   
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }
        
        $model = new Systemrole();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_system_role]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_system_role]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
		if (Yii::$app->user->isGuest) {
			header("Location: index.php");
			exit();
		}

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Systemrole::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
