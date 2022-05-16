<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "production_line".
 *
 * @property int $id
 * @property string|null $dep_name
 * @property string|null $dep_code
 * @property int|null $unit
 */
class ProductionLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'production_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit'], 'integer'],
            [['dep_name'], 'string', 'max' => 250],
            [['dep_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dep_name' => 'Dep Name',
            'dep_code' => 'Dep Code',
            'unit' => 'Unit',
        ];
    }
    public static function generalData($dep_id,$typeData)
    {

        switch ($typeData) {
            case 'patientNumber':
                $repData = ReportData::find()->where(['department_code'=>$dep_id])->count();
                break;
            case 'patientDaily':
                $repData = ReportData::find()->where(['datetime'=>date('Y-m-d')])->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'tahlil':
                $repData = ReportData::find()
                    ->where(['department_code'=>$dep_id])
                    ->andWhere(['not', ['date_analys_taken' => null]])
                    ->count();
                break;
            case 'musbat':
                $repData = ReportData::find()->where(['tahlil_result' => 'Musbat'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'Manfiy':
                $repData = ReportData::find()->where(['tahlil_result' => 'Manfiy'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'Gumon':
                $repData = ReportData::find()->where(['tahlil_result' => 'Gumon'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'Qayta_tahlilga':
                $repData = ReportData::find()->where(['tahlil_result' => 'Qayta_tahlilga'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break; //
            case 'Tahlil_kutilmoqda':
                $repData = ReportData::find()->where(['tahlil_result' => 'Tahlil_kutilmoqda'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'mavjud_emas':
                $repData = ReportData::find()->where(['tahlil_result' => 'mavjud_emas'])->groupBy('tabel')->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'case':
                $repData = ReportData::find()->where(['is_cured' => 1])->andWhere(['department_code'=>$dep_id])->count();
                break;
            case 'Yaxshi':
                $repData = ReportData::find()->where(['case' => 'Yaxshi'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ogir':
                $repData = ReportData::find()->where(['case' => 'Ogir'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Yengil':
                $repData = ReportData::find()->where(['case' => 'Yengil'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ota_ogir':
                $repData = ReportData::find()->where(['case' => 'Ota_ogir'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Vafot_etdi':
                $repData = ReportData::find()->where(['case' => 'Vafot_etdi'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uyda':
                $repData = ReportData::find()->where(['present_location' => 'Uyda'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Shifoxonada':
                $repData = ReportData::find()->where(['present_location' => 'Shifoxonada'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uy_karantinida':
                $repData = ReportData::find()->where(['present_location' => 'Uy_karantinida'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Karantinda':
                $repData = ReportData::find()->where(['present_location' => 'Karantinda'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ishga_chiqdi':
                $repData = ReportData::find()->where(['present_location' => 'Ishga_chiqdi'])->andWhere(['department_code'=>$dep_id])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
        }
        return $repData;
    }

    public static function summary($typeData)
    {
        switch ($typeData) {
            case 'summaryPatients':
                $repData = ReportData::find()->where(['parent_department_id'=>32000000])->count();
                break;
            case 'patientDaily':
                $repData = ReportData::find()->where(['datetime'=>date('Y-m-d')])->andWhere(['parent_department_id'=>32000000])->count();
                break;
            case 'tahlil':
                $repData = ReportData::find()
                    ->andWhere(['not', ['date_analys_taken' => null]])
                    ->andWhere(['parent_department_id'=>32000000])
                    ->count();
                break;
            case 'musbat':
                $repData = ReportData::find()->where(['tahlil_result' => 'Musbat'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break;
            case 'Manfiy':
                $repData = ReportData::find()->where(['tahlil_result' => 'Manfiy'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break;
            case 'Gumon':
                $repData = ReportData::find()->where(['tahlil_result' => 'Gumon'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break;
            case 'Qayta_tahlilga':
                $repData = ReportData::find()->where(['tahlil_result' => 'Qayta_tahlilga'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break; //
            case 'Tahlil_kutilmoqda':
                $repData = ReportData::find()->where(['tahlil_result' => 'Tahlil_kutilmoqda'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break;
            case 'mavjud_emas':
                $repData = ReportData::find()->where(['tahlil_result' => 'mavjud_emas'])->andWhere(['parent_department_id'=>32000000])->groupBy('tabel')->count();
                break;
            case 'case':
                $repData = ReportData::find()->where(['is_cured' => 1])->andWhere(['parent_department_id'=>32000000])->count();
                break;
            case 'Yaxshi':
                $repData = ReportData::find()->where(['case' => 'Yaxshi'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ogir':
                $repData = ReportData::find()->where(['case' => 'Ogir'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Yengil':
                $repData = ReportData::find()->where(['case' => 'Yengil'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ota_ogir':
                $repData = ReportData::find()->where(['case' => 'Ota_ogir'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Vafot_etdi':
                $repData = ReportData::find()->where(['case' => 'Vafot_etdi'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uyda':
                $repData = ReportData::find()->where(['present_location' => 'Uyda'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Shifoxonada':
                $repData = ReportData::find()->where(['present_location' => 'Shifoxonada'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Uy_karantinida':
                $repData = ReportData::find()->where(['present_location' => 'Uy_karantinida'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Karantinda':
                $repData = ReportData::find()->where(['present_location' => 'Karantinda'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
            case 'Ishga_chiqdi':
                $repData = ReportData::find()->where(['present_location' => 'Ishga_chiqdi'])->andWhere(['parent_department_id'=>32000000])->orderBy('id DESC')->groupBy('tabel')->count();
                break;
        }
        return $repData;
    }

}
