<?php

namespace backend\controllers;

use Yii;
use backend\models\Login;
use backend\models\LoginSearch;
use backend\models\Systemrole;
use backend\models\Userrole;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LoginController implements the CRUD actions for Login model.
 */
class LoginController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Login models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $searchModel = new LoginSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Login model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $hakakses = Systemrole::find()->orderBy("nama_role")->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'hakakses' => $hakakses,
        ]);
    }
	
	public function actionProfile($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
			
			$model->foto = UploadedFile::getInstance($model, 'foto');
            
			$model->save();
		
		
        }
		
        return $this->render('view_profile', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionHakakses($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }


        if (is_array(Yii::$app->request->post('data')))
        {
            Userrole::deleteAll(["id_login"=>$id]);
            //echo var_dump(Yii::$app->request->post('data'))."<br>";
            foreach (Yii::$app->request->post('data') as $key => $data)
            {
                $cek = Userrole::find()->where(["id_system_role"=>$key, "id_login"=>$id])->count();
                if ($cek < 1)
                {
                    $simpan = new Userrole();
                    $simpan->id_system_role = $key;
                    $simpan->id_login = $id;
                    $simpan->save(false);
                    
                }
                
            }

            Yii::$app->session->setFlash("success","Data hak akses berhasil disimpan.");
        }
        else
        {
            Userrole::deleteAll(["id_login"=>$id]);
        }

        

        $hakakses = Systemrole::find()->orderBy("nama_role")->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'hakakses' => $hakakses,
        ]);
    }

    /**
     * Creates a new Login model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $model = new Login();

        if ($model->load(Yii::$app->request->post())  ) {
			
			 
            $model->foto = UploadedFile::getInstance($model, 'foto');
            
			
			$model->save();
		
		
            return $this->redirect(['view', 'id' => $model->id_login]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Login model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
			
			$model->foto = UploadedFile::getInstance($model, 'foto');
            
			$model->save();
		
		
            return $this->redirect(['view', 'id' => $model->id_login]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Login model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) { 
            header("Location: index.php");
            exit;
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Login model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Login the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Login::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
