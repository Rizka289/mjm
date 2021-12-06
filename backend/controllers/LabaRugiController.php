<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LabaRugiController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$tanggal1 = Yii::$app->request->post('tanggal1');
        $tanggal2 = Yii::$app->request->post('tanggal2');

        return $this->render('index', [
           'tanggal1' => $tanggal1,
           'tanggal2' => $tanggal2,
       ]);
    }


    public function actionExportLabaRugi($tanggal1, $tanggal2)
    {
        return $this->renderPartial('export_laba_rugi', [
            'tanggal1' => $tanggal1,
            'tanggal2' => $tanggal2,
        ]);
    }

}
