<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "daily_questionnaire".
 *
 * @property int $id
 * @property string $tahlil_result
 * @property string $case
 * @property string|null $present_location
 * @property string|null $kasallik_caraqa
 * @property string|null $desc
 */
class DailyQuestionnaire extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daily_questionnaire';
    }
    public $ishga_chiqish_sanasi;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahlil_result', 'case'], 'required'],
            [['desc'], 'string'],
            [['tahlil_result', 'case', 'kasallik_caraqa','dep_code'], 'string', 'max' => 100],
            [['present_location'], 'string', 'max' => 200],
            [['user_id','date'],'integer'],
            [['ishga_chiqish_sanasi'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahlil_result' => 'Tahlil natijasi',
            'case' => 'Xolati',
            'present_location' => 'Xozirda qayerda',
            'kasallik_caraqa' => 'Kasallik varaqasi',
            'desc' => 'Izoh',
            'ishga_chiqish_sanasi'=>'Ishga chiqish sanasi',
        ];
    }

    public function getDep()
    {
        return $this->hasOne(ReportData::className(), ['tabel' => 'tabel']);
    }
}
