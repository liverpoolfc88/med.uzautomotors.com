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
	    if($model->load(Yii::$app->request->post() )){
		    $statisticsDateBegin = ProblemMonitorings::GetStatisticsDateStart($model->dateSearch);
		    $statisticsDateFinish = ProblemMonitorings::GetStatisticsDateEnd($model->dateSearch);

		    ProblemMonitorings::ExportDatas($statisticsDateBegin,$statisticsDateFinish);
	    }

    }

    public function actionIndex(){


        $musbatAll = DailyQuestionnaire::find()
            ->where(['tahlil_result'=> 'Musbat'])
            ->select(['tabel','tahlil_result'])
            ->distinct()
            ->orderBy(['tabel' => SORT_DESC])
            ->all();
        $musbat = count($musbatAll);

        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result'=>'Manfiy'])->groupBy('tabel')->all();
        $manfiyArray = [];
        foreach ($musbatAll as $value){
            foreach ($manfiyy as $val){
                if ($value->tabel == $val->tabel){
                    array_push($manfiyArray, (object)
                    [
                        'tahlil_result' => $val->tahlil_result,
                        'tabel' => $val->tabel,
                    ]);

                }
            }
        }
        $countManfiy = count($manfiyArray);
        $dav = \app\models\ReportData::summary('musbat');
        $array_count=[
            [
                'label'=>'COVID aniqlanganlar',
                'value'=>$musbat
            ],
            [
                'label'=>'Tuzalganlar(COVID)',
//                'value'=>$countManfiy
                'value'=>$musbat-$dav
            ],
            [
                'label'=>'Davolanayotganlar',
//                'value'=>$musbat-$countManfiy
                'value'=>$dav
            ],

        ];

//        $date = date('Y-m-d');
//        $final = date("Y-m", strtotime("-1 month"));
//        $jadval = Problem::find()->andFilterWhere(['between', 'date', $startDT,$endDT])->all();

        $month  = '('.date("m", strtotime("-1 month")).')'.'-'.'('.date('m').')';
        $month1 = '('.date("m", strtotime("-2 month")).')'.'-'.'('.date("m", strtotime("-1 month")).')';
        $month2 = '('.date("m", strtotime("-3 month")).')'.'-'.'('.date("m", strtotime("-2 month")).')';
        $month3 = '('.date("m", strtotime("-4 month")).')'.'-'.'('.date("m", strtotime("-3 month")).')';
        $month4 = '('.date("m", strtotime("-5 month")).')'.'-'.'('.date("m", strtotime("-4 month")).')';

//        $mus_manfiy = [];
//        foreach ($musbatAll as  $mus_value){
//            $mus_manfiy[] = $mus_value->tabel;
//        }
//        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result'=>'Manfiy'])->andWhere(['in', 'tabel', $mus_manfiy])->groupBy('tabel')->count();

//        $date = date('Y-m-d');
//        $date1 = date('Y-m-d', strtotime('-25 year'));
//
//        $date2 = date('Y-m-d', strtotime('-35 year'));
//
//        $date3 = date('Y-m-d', strtotime('-45 year'));
//
//        $date4 = date('Y-m-d', strtotime('-55 year'));
//
//        $date5 = date('Y-m-d', strtotime('-200 year'));
//
//        $yosh1 =  ReportData::find()->andFilterWhere(['between', 'date_of_birth', $date1,$date])->andWhere(['in', 'tabel', $mus_manfiy])
//            ->groupBy('tabel')->count();
////            ->all();
//        $yosh2 =  ReportData::find()->andFilterWhere(['between', 'date_of_birth', $date2,$date1])->andWhere(['in', 'tabel', $mus_manfiy])
//            ->groupBy('tabel')->count();
////        ->all();
//        $yosh3 =  ReportData::find()->andFilterWhere(['between', 'date_of_birth', $date3,$date2])->andWhere(['in', 'tabel', $mus_manfiy])
//            ->groupBy('tabel')->count();
////        ->all();
//        $yosh4 =  ReportData::find()->andFilterWhere(['between', 'date_of_birth', $date4,$date3])->andWhere(['in', 'tabel', $mus_manfiy])
//            ->groupBy('tabel')->count();
////        ->all();
//        $yosh5 =  ReportData::find()->andFilterWhere(['between', 'date_of_birth', $date5,$date4])->andWhere(['in', 'tabel', $mus_manfiy])
//            ->groupBy('tabel')->count();
////        ->all();

//        var_dump($yosh1); die();


//        ];
        $departments = Departments::find()->all();
        $array2 = [];
        $array = [];
        foreach ($departments as $val){
            if ($val->dep_code != 32000000){
                array_push($array, (object)
                [
                    'name' => $val->dep_name,
                    'y' => $val->dep_code,
                    'a'=>ReportData::generalData($val->dep_code,'patientNumber'),
                    'b'=>ReportData::generalData($val->dep_code,'musbat')
                ]);
            }
            else{
                array_push($array2, (object)
                [
                    'name' => $val->dep_name,
                    'y' => $val->dep_code,
                    'a'=>ReportData::generalData($val->dep_code,'patientNumber'),
                    'b'=>ReportData::generalData($val->dep_code,'musbat')
                ]);
            }



        }

//        var_dump($array2[0]->name);die();
//        var_dump($array2);die();

        return $this->render('index', [
            'musbat' => json_encode($musbat),
            'countManfiy' => json_encode($countManfiy),
            'array'=> json_encode($array),
            'array2'=> ($array2),
            'array_count'=>json_encode($array_count),
//            'repData'=>$repData
        ]);
    }

    public function actionArrayCount(){
        $arraycount=[
            [
                'label'=>'COVID aniqlanganlar',
                'value'=>12
            ],
            [
                'label'=>'Tuzalganlar(COVID)',
                'value'=>25
            ],
            [
                'label'=>'Davolanayotganlar',
                'value'=>32
            ],
        ];
        return json_encode($arraycount);
    }

    public function actionAsosiy(){
        $musbatAll = DailyQuestionnaire::find()
            ->where(['tahlil_result'=> 'Musbat'])
            ->select(['tabel','tahlil_result'])
            ->distinct()
            ->orderBy(['tabel' => SORT_DESC])
            ->all();

        $countMusbat = count($musbatAll);
        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result'=>'Manfiy'])->groupBy('tabel')->all();
        $manfiyArray = [];

        foreach ($musbatAll as $value){
            foreach ($manfiyy as $val){
                if ($value->tabel == $val->tabel){
                    array_push($manfiyArray, (object)
                    [
                        'tahlil_result' => $val->tahlil_result,
                        'tabel' => $val->tabel,
                    ]);

                }
            }
        }



//        $mus_manfiy = [];
//        foreach ($musbatAll as  $mus_value){
//            $mus_manfiy[] = $mus_value->tabel;
//        }
//        $manfiyy = DailyQuestionnaire::find()->where(['tahlil_result'=>'Manfiy'])->andWhere(['in', 'tabel', $mus_manfiy])->groupBy('tabel')->count();

        $countManfiy = count($manfiyArray);

        // $not_employed = DailyQuestionnaire::find()->where(['<>','present_location','Ishga_chiqdi'])->select(['tabel','tahlil_result'])->distinct()->all();
        // $not_employed = count($not_employed);

        $not_employed = ReportData::find()->where(['<>','present_location','Ishga_chiqdi'])->groupBy('tabel')->count();

        $died = DailyQuestionnaire::find()->where(['case'=>'Vafot_etdi'])->groupBy('tabel')->count();


        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $departments = Departments::find()->all();
        /*for cars report n1*/

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
        return $this->render('production_line',compact('departments'));
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

         return $this->redirect(['site/login']);
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
