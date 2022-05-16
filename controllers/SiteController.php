<?php

namespace app\controllers;

use app\models\Departments;
use app\models\ReportData;
use app\models\ProductionLine;
use app\models\DailyQuestionnaire;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use function GuzzleHttp\Promise\all;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*public function behaviors()
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
                        'actions' => ['logout', 'index','manageCountry'],
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
    }*/


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionExel()
    {
        $model = new ProblemMonitorings();
        if ($model->load(Yii::$app->request->post())) {
            $statisticsDateBegin = ProblemMonitorings::GetStatisticsDateStart($model->dateSearch);
            $statisticsDateFinish = ProblemMonitorings::GetStatisticsDateEnd($model->dateSearch);

            ProblemMonitorings::ExportDatas($statisticsDateBegin, $statisticsDateFinish);
        }
    }

    public function actionIndex()
    {
        $musbatAll = DailyQuestionnaire::find()
            ->where(['tahlil_result' => 'Musbat'])
            ->select(['tabel', 'tahlil_result'])
            ->distinct()
            ->orderBy(['tabel' => SORT_DESC])
            ->all();
        $musbat = count($musbatAll);

        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result' => 'Manfiy'])->groupBy('tabel')->all();
        $manfiyArray = [];
        foreach ($musbatAll as $value) {
            foreach ($manfiyy as $val) {
                if ($value->tabel == $val->tabel) {
                    array_push($manfiyArray, (object)
                    [
                        'tahlil_result' => $val->tahlil_result,
                        'tabel' => $val->tabel,
                    ]);

                }
            }
        }
        $countManfiy = count($manfiyArray);
        $dav = ReportData::summary('musbat');
        $array_count = [
            [
                'label' => 'COVID aniqlanganlar',
                'value' => $musbat
            ],
            [
                'label' => 'Tuzalganlar(COVID)',
//                'value'=>$countManfiy
                'value' => $musbat - $dav
            ],
            [
                'label' => 'Davolanayotganlar',
                'value' => $dav
            ],

        ];
        $departments = Departments::find()->all();
        $array2 = [];
        $array = [];
        foreach ($departments as $val) {
            if ($val->dep_code != 32000000) {
                array_push($array, (object)
                [
                    'name' => $val->dep_name,
                    'y' => $val->dep_code,
                    'a' => ReportData::generalData($val->dep_code, 'patientNumber'),
                    'b' => ReportData::generalData($val->dep_code, 'musbat')
                ]);
            } else {
                array_push($array2, (object)
                [
                    'name' => $val->dep_name,
                    'y' => $val->dep_code,
                    'a' => ReportData::generalData($val->dep_code, 'patientNumber'),
                    'b' => ReportData::generalData($val->dep_code, 'musbat')
                ]);
            }
        }
        return $this->render('index', [
            'musbat' => json_encode($musbat),
            'countManfiy' => json_encode($countManfiy),
            'array' => json_encode($array),
            'array2' => ($array2),
            'array_count' => json_encode($array_count),
        ]);
    }

    public function actionArrayCount()
    {
        $arraycount = [
            [
                'label' => 'COVID aniqlanganlar',
                'value' => 12
            ],
            [
                'label' => 'Tuzalganlar(COVID)',
                'value' => 25
            ],
            [
                'label' => 'Davolanayotganlar',
                'value' => 32
            ],
        ];
        return json_encode($arraycount);
    }

    public function actionMus()
    {

        $musbat = DailyQuestionnaire::find()
            ->select(['tabel', 'tahlil_result'])
            ->where(['tahlil_result' => 'Musbat'])
//            ->distinct()
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->all();
//        var_dump($musbat); die();
        return $this->render('mus', [
            'musbat' => $musbat,
        ]);
    }

    public function actionMusnaw()
    {
        $musbatnaw = ReportData::find()
            ->select(['tabel', 'tahlil_result', 'fullname', 'date_of_birth', 'home_address', 'phone', 'department_code'])
//            ->where(['case' => 'Vafot_etdi'])
            ->where(['tahlil_result' => 'Musbat'])
            ->andWhere(['!=','case', 'Vafot_etdi'])
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->all();
        return $this->render('musnaw', [
            'musbatnaw' => $musbatnaw,
        ]);
    }

    public function actionDied()
    {
        $died = DailyQuestionnaire::find()
            ->select(['tabel', 'tahlil_result', 'case'])
            ->where(['case' => 'Vafot_etdi'])
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->all();
        return $this->render('died', [
            'died' => $died,
        ]);
    }

    public function actionCountasosiy()
    {
        $musbat = DailyQuestionnaire::find()
            ->select(['tabel', 'tahlil_result'])
            ->where(['tahlil_result' => 'Musbat'])
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->count();

        $musbatnaw = ReportData::find()
            ->select(['tabel', 'tahlil_result', 'fullname', 'date_of_birth', 'home_address', 'phone', 'department_code'])
            ->where(['tahlil_result' => 'Musbat'])
            ->andWhere(['!=','case', 'Vafot_etdi'])
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->count();

        $died = DailyQuestionnaire::find()
            ->select(['tabel', 'tahlil_result', 'case'])
            ->where(['case' => 'Vafot_etdi'])
            ->groupBy('tabel')
            ->orderBy(['tabel' => SORT_DESC])
            ->count();


        \Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'musbat'=>$musbat,
                'musbatnaw'=>$musbatnaw,
                'died'=>$died
                ];
//        var_dump($musbat, $musbatnaw,$died); die();
    }

    public function actionAsosiy()
    {
        $musbatAll = DailyQuestionnaire::find()
            ->select(['tabel', 'tahlil_result'])
            ->where(['tahlil_result' => 'Musbat'])
            ->distinct()
            ->orderBy(['tabel' => SORT_DESC])
            ->all();

        $countMusbat = count($musbatAll);
        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result' => 'Manfiy'])->groupBy('tabel')->all();
        $manfiyArray = [];

        foreach ($musbatAll as $value) {
            foreach ($manfiyy as $val) {
                if ($value->tabel == $val->tabel) {
                    array_push($manfiyArray, (object)
                    [
                        'tahlil_result' => $val->tahlil_result,
                        'tabel' => $val->tabel,
                    ]);

                }
            }
        }
        $countManfiy = count($manfiyArray);

        $not_employed = ReportData::find()->where(['<>', 'present_location', 'Ishga_chiqdi'])->groupBy('tabel')->count();

        $died = DailyQuestionnaire::find()->where(['case' => 'Vafot_etdi'])->groupBy('tabel')->count();


//        if (Yii::$app->user->isGuest) {
//            return $this->redirect(['site/login']);
//        }
        $departments = Departments::find()->all();

        return $this->render('asosiy',
            compact(
                'departments',
                'countMusbat',
                'not_employed',
                'countManfiy',
                'died'
            ));
    }

    public function actionProductionLine()
    {
        $departments = ProductionLine::find()->all();
        return $this->render('production_line', compact('departments'));
    }

    public function actionLogin()
    {
        {
            // user is logged in, he doesn't need to login
            $this->layout = "user-login";
            if (!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            // get setting value for 'Login With Email'
            $lwe = Yii::$app->params['lwe'];

            // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
            $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

            // monitor login status
            $successfulLogin = true;

            // posting data or login has failed
            if (!$model->load(Yii::$app->request->post()) || !$model->login()) {
                $successfulLogin = false;
            }

            // if user's account is not activated, he will have to activate it first
            if ($model->status === 0 && $successfulLogin === false) {
                Yii::$app->session->setFlash('error', Yii::t('app',
                    'You have to activate your account first. Please check your email.'));
                return $this->refresh();
            }

            // if user is not denied because he is not active, then his credentials are not good
            if ($successfulLogin === false) {
                return $this->render('login', ['model' => $model]);
            }

            // login was successful, let user go wherever he previously wanted
            return $this->goBack();
        }

    }

    /**
     * Logout action.
     *
     * @return Response
     */

    public function actionLogout()
    {
        Yii::$app->user->logout();

//        return $this->redirect(['site/login']);
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
