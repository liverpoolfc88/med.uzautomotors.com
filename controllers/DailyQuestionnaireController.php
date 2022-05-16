<?php

namespace app\controllers;

use app\models\ReportData;
use Yii;
use app\models\DailyQuestionnaire;
use app\models\DailyQuestionnaireSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DailyQuestionnaireController implements the CRUD actions for DailyQuestionnaire model.
 */
class DailyQuestionnaireController extends Controller
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
     * Lists all DailyQuestionnaire models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DailyQuestionnaireSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $employees = ReportData::find()->orderBy('datetime DESC')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employees' => $employees,
        ]);
    }

    /**
     * Displays a single DailyQuestionnaire model.
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
     * Creates a new DailyQuestionnaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tabel)
    {
        $model = new DailyQuestionnaire();
        $userData = ReportData::findOne(['tabel'=>$tabel]);
        $userHistory = DailyQuestionnaire::findAll(['tabel'=>$tabel]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->user_id = Yii::$app->user->id;
            $model->date = date('Y-m-d H:i:s');
            $model->tabel = $userData->tabel;
            $model->dep_code = $model->dep->parent_department_id;

            $model->save(false);
            $report = ReportData::find()->where(['tabel'=>$tabel])->one();
            if($report->tabel) {
                $report->case = $model->case;
                $report->tahlil_result = $model->tahlil_result;
                $report->present_location = $model->present_location;
                $report->kasallik_varaqa=$model->kasallik_caraqa;
                $report->desc = $model->desc;
                $report->date = $model->date;
                $report->ishga_chiqish_sanasi =$model->ishga_chiqish_sanasi;
                $report->save(false);
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('create', [
            'model' => $model,
            'userData' => $userData,
            'userHistory' => $userHistory,
        ]);
    }

    /**
     * Updates an existing DailyQuestionnaire model.
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
     * Deletes an existing DailyQuestionnaire model.
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
     * Finds the DailyQuestionnaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DailyQuestionnaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DailyQuestionnaire::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
