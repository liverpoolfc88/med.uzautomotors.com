<?php

namespace app\controllers;

use Yii;
use app\models\ReportData;
use app\models\ReportDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportDataController implements the CRUD actions for ReportData model.
 */
class ReportDataController extends Controller
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
    public function beforeAction($action)
    {
        if ((Yii::$app->user->isGuest)) {
            return $this->goHome();
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all ReportData models.
     * @return mixed
     */

    /*for cars report n1*/



    public function actionIndex()
    {
        $searchModel = new ReportDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new ReportData();
        $model->scenario = ReportData::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['create', 'tabel' => $model->tabelCheck]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single ReportData model.
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
     * Creates a new ReportData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tabel)
    {
       $checkExist = ReportData::find()->where(['tabel'=>$tabel])->exists();
        if($checkExist) {
            Yii::$app->session->setFlash('success', "Ushbu foydalanuvchi tizimda mavjud!");
            return $this->redirect(['index']);
        }

        $model = new ReportData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->created_by = Yii::$app->user->id;
            $model->datetime = date('Y-m-d');
            $model->department_code = substr($model->department_code,0,3);
            $sana =date_create($model->date_analys_result);
            $ishga_chiqadigon_kun = date_add($sana,date_interval_create_from_date_string("20 days"));
            $model->ishga_chiqish_sanasi = date_format($ishga_chiqadigon_kun,"Y-m-d");;
            $model->save(false);
            return $this->redirect(['daily-questionnaire/create', 'tabel' => $model->tabel]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionTest()
    {
        $reportData = ReportData::find()->all();
        foreach ($reportData as $report) {
            $report->department_code = substr($report->department_code,0,3);
            $report->save(false);
        }
    }

    /**
     * Updates an existing ReportData model.
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
     * Deletes an existing ReportData model.
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
     * Finds the ReportData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReportData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
