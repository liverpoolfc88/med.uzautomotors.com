<?php

namespace app\controllers;

use Yii;
use app\models\Vaccine;
use app\models\VaccineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VaccineController implements the CRUD actions for Vaccine model.
 */
class VaccineController extends Controller
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
     * Lists all Vaccine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VaccineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Vaccine();
//        $model->scenario = Vaccine::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post())) {
//            var_dump($model->tb_number);
            return $this->redirect(['create', 'tabel' => $model->tb_number]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' =>$model
        ]);
    }

    /**
     * Displays a single Vaccine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vaccine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tabel)
    {
        $checkExist = Vaccine::find()->where(['tb_number'=>$tabel])->exists();

        if ($checkExist){
            Yii::$app->session->setFlash('vaccina', "Ushbu tabel raqam egasi vaksina olgan!");
            return $this->redirect(['index']);
        }

        $model = new Vaccine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'tabel' =>$tabel
        ]);
    }

    /**
     * Updates an existing Vaccine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vaccine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vaccine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vaccine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vaccine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
