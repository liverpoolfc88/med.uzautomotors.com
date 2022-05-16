<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_data".
 *
 * @property int $id
 * @property string $fullname
 * @property string $tabel
 * @property int|null $department_code
 * @property string|null $profession
 * @property string|null $date_of_birth
 * @property string|null $home_address
 * @property string|null $phone
 * @property string|null $kasallik_varaqa
 * @property string|null $diagnosis
 * @property string|null $date_informed
 * @property string|null $complain
 * @property string|null $date_analys_taken
 * @property string|null $date_analys_result
 * @property string|null $tah_taken_instution
 * @property int|null $created_by
 * @property string|null $datetime
 */
class ReportData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $tabelCheck;
    const SCENARIO_CREATE = 'create';
    public static function tableName()
    {
        return 'report_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'tabel'], 'required'],
            [['department_code', 'created_by','parent_department_id','is_cured'], 'integer'],
            [['date_of_birth', 'date_informed', 'date_analys_taken', 'date_analys_result', 'datetime','tahlil_result','ishga_chiqish_sanasi'], 'safe'],
            [['fullname', 'home_address', 'complain','profession'], 'string', 'max' => 255],
            [['tabel','tabelCheck'], 'string', 'max' => 20],
            [[ 'phone'], 'string', 'max' => 100],
            [['diagnosis','parent_department_name'], 'string', 'max' => 200],
            [['tabelCheck'], 'required', 'on' => self::SCENARIO_CREATE,'message'=>'Tabelni kiritish majburiy'],
            [['tabelCheck'], 'unique'],
            [['case','present_location','kasallik_varaqa','desc','date'],'safe'],
            [['tah_taken_instution'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Ism sharifi',
            'tabel' => 'Tabel raqami',
            'department_code' => 'Bo\'lim raqami',
            'profession' => 'Lavozimi',
            'date_of_birth' => 'Tug\'ilgan sanasi',
            'home_address' => 'Uy manzili',
            'phone' => 'Telefon raqami',
            'diagnosis' => 'Tashxisi',
            'date_informed' => 'Murojat qilgan sana',
            'complain' => 'Shikoyati',
            'date_analys_taken' => 'Tahlil olingan sana',
            'date_analys_result' => 'Tahlil natijasi chiqgan sana',
            'tah_taken_instution' => 'Tahlil olingan muassasa',
            'created_by' => 'Kiritgan foydalanuvchi',
            'datetime' => 'Ma\'lumot kiritilgan sana',
            'parent_department_name'=>'Bo\'lim nomi',
            'is_cured'=>'Hozirgi  holati',
            'tahlil_result'=>'Tahlil natijasi'
        ];
    }




    public static function generalData($dep_id,$typeData)
    {
        switch ($typeData) {
            case 'patientNumber':
               $repData = ReportData::find()->where(['parent_department_id'=>$dep_id])->count();
                break;
            case 'patientDaily':
                $repData = ReportData::find()->where(['datetime'=>date('Y-m-d')])->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'tahlil':
                $repData = ReportData::find()
                    ->where(['parent_department_id'=>$dep_id])
                    ->andWhere(['not', ['date_analys_taken' => null]])
                    ->count();
                break;
            case 'musbat':
                $repData = ReportData::find()->where(['tahlil_result' => 'Musbat'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'Manfiy':
                $repData = ReportData::find()->where(['tahlil_result' => 'Manfiy'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'Gumon':
                $repData = ReportData::find()->where(['tahlil_result' => 'Gumon'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'Qayta_tahlilga':
                $repData = ReportData::find()->where(['tahlil_result' => 'Qayta_tahlilga'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break; //
            case 'Tahlil_kutilmoqda':
                $repData = ReportData::find()->where(['tahlil_result' => 'Tahlil_kutilmoqda'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'mavjud_emas':
                $repData = ReportData::find()->where(['tahlil_result' => 'mavjud_emas'])->groupBy('tabel')->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'case':
                $repData = ReportData::find()->where(['is_cured' => 1])->andWhere(['parent_department_id'=>$dep_id])->count();
                break;
            case 'Yaxshi':
                $repData = ReportData::find()->where(['case' => 'Yaxshi'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ogir':
                $repData = ReportData::find()->where(['case' => 'Ogir'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Yengil':
                $repData = ReportData::find()->where(['case' => 'Yengil'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ota_ogir':
                $repData = ReportData::find()->where(['case' => 'Ota_ogir'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Vafot_etdi':
                $repData = ReportData::find()->where(['case' => 'Vafot_etdi'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uyda':
                $repData = ReportData::find()->where(['present_location' => 'Uyda'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Shifoxonada':
                $repData = ReportData::find()->where(['present_location' => 'Shifoxonada'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uy_karantinida':
                $repData = ReportData::find()->where(['present_location' => 'Uy_karantinida'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Karantinda':
                $repData = ReportData::find()->where(['present_location' => 'Karantinda'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ishga_chiqdi':
                $repData = ReportData::find()->where(['present_location' => 'Ishga_chiqdi'])->andWhere(['parent_department_id'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
        }
        return $repData;
    }

        public static function summary($typeData)
        {
            switch ($typeData) {
                case 'summaryPatients':
                    $repData = ReportData::find()->count();
                    break;
                case 'patientDaily':
                    $repData = ReportData::find()->where(['datetime'=>date('Y-m-d')])->count();
                    break;
                case 'tahlil':
                    $repData = ReportData::find()
                        ->andWhere(['not', ['date_analys_taken' => null]])
                        ->count();
                    break;
                case 'musbat':
                    $repData = ReportData::find()->where(['tahlil_result' => 'Musbat'])->groupBy('tabel')->count();
                    break;
                case 'Manfiy':
                    $repData = ReportData::find()->where(['tahlil_result' => 'Manfiy'])->groupBy('tabel')->count();
                    break;
                case 'Gumon':
                    $repData = ReportData::find()->where(['tahlil_result' => 'Gumon'])->groupBy('tabel')->count();
                    break;
                case 'Qayta_tahlilga':
                    $repData = ReportData::find()->where(['tahlil_result' => 'Qayta_tahlilga'])->groupBy('tabel')->count();
                    break; //
                case 'Tahlil_kutilmoqda':
                    $repData = ReportData::find()->where(['tahlil_result' => 'Tahlil_kutilmoqda'])->groupBy('tabel')->count();
                    break;
                case 'mavjud_emas':
                    $repData = ReportData::find()->where(['tahlil_result' => 'mavjud_emas'])->groupBy('tabel')->count();
                    break;
                case 'case':
                    $repData = ReportData::find()->where(['is_cured' => 1])->count();
                    break;
                case 'Yaxshi':
                    $repData = ReportData::find()->where(['case' => 'Yaxshi'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Ogir':
                    $repData = ReportData::find()->where(['case' => 'Ogir'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Yengil':
                    $repData = ReportData::find()->where(['case' => 'Yengil'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Ota_ogir':
                    $repData = ReportData::find()->where(['case' => 'Ota_ogir'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Vafot_etdi':
                    $repData = ReportData::find()->where(['case' => 'Vafot_etdi'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Uyda':
                    $repData = ReportData::find()->where(['present_location' => 'Uyda'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Shifoxonada':
                    $repData = ReportData::find()->where(['present_location' => 'Shifoxonada'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Uy_karantinida':
                    $repData = ReportData::find()->where(['present_location' => 'Uy_karantinida'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Karantinda':
                    $repData = ReportData::find()->where(['present_location' => 'Karantinda'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
                case 'Ishga_chiqdi':
                    $repData = ReportData::find()->where(['present_location' => 'Ishga_chiqdi'])->orderBy('id DESC')->groupBy('tabel')->count();
                    break;
            }
            return $repData;
        }

    public function getTahlilResult()
    {
        return $this->hasOne(DailyQuestionnaire::className(), ['tabel' => 'tabel']);
    }
    public function getProd()
    {
        return $this->hasOne(ProductionLine::className(), ['dep_code' => 'department_code']);
    }
}
