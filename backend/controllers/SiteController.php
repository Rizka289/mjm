<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\Log;
use backend\models\Karyawan;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	public function actionError()
{
    $exception = Yii::$app->errorHandler->exception;
    if ($exception !== null) {
        return $this->render('error', ['exception' => $exception]);
    }
}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {            
            return $this->goBack();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $input_log = new Log();
            $input_log->level = '0';
            $input_log->category = 'Login';
            $input_log->log_time = microtime('get_as_float');
            $input_log->prefix = Yii::$app->user->identity->nama;
            $input_log->message = 'Login';
            $input_log->save(false);

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        
        
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUnlock()
    {
        // if (Yii::$app->user->isGuest) {
        //     header("Location: index.php
        //     exit();
        // }

        // $searchModel = new KaryawanSearch();
        // $dataProvider = $searchModel->searchLock(Yii::$app->request->queryParams);

        // $dataProvider->pagination->pageSize=100;

        $datalockdriver = Yii::$app->db->createCommand("SELECT * FROM karyawan")->query();
        foreach ($datalockdriver as $key => $value) {
            # code...
            $tanggal_lock   = $value['tanggal_lock'];
            $status_lock    = $value['status_lock'];
            $id_karyawan    = $value['id_karyawan'];
            //echo $tanggal_lock.'<br>';

            //$tanggal_lock       = '2020-06-12'; //tanggal_lock
            $tanggal_sekarang   = date('Y-m-d'); //tanggal hari ini

            $date       = new \DateTime($tanggal_lock);
            $date_plus  = $date->modify("+2 days");
            $date_hasil = $date_plus->format("Y-m-d");

            if ($tanggal_sekarang == $date_hasil AND $status_lock == 1) {
                # code...
                echo 'unlock <br>';
                $update1 = Karyawan::find()->where(["id_karyawan" => $id_karyawan])->one();
                $update1->is_lock = 0;
                $update1->status_lock = 0;
                $update1->save(false);
            } else {
                echo 'lock <br>';
            }
        }

        // return $this->render('lock', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }
   
}