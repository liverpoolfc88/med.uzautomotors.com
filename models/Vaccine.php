<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vaccine".
 *
 * @property int $id
 * @property string $tb_number
 * @property string|null $fullname
 * @property string|null $birth_day
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Vaccine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tb_number'], 'required'],
            [['birth_day', 'created_at', 'updated_at'], 'safe'],
            [['tb_number'], 'string', 'max' => 11],
            [['fullname'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_number' => 'Tabel raqami',
            'fullname' => 'To`liq ism hsarifi',
            'birth_day' => 'Tug`ilgan sanasi',
            'created_at' => 'Qo`shilgan sana',
            'updated_at' => 'O`zgartirilgan sana',
        ];
    }

    public function beforeSave($insert){
        if($insert){

            $this->created_at = date('Y-m-d H:i:s');
        }else{

            $this->updated_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
