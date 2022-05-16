<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vaccine */
/* @var $form yii\widgets\ActiveForm */


//var_dump($_GET); die();

//if ($model->isNewRecord):
$api = "http://b-edo.uzautomotors.com/api/get-all-employees/" . $_GET['tabel'];
$api2 = "http://b-edo.uzautomotors.com/api/getParentDepartment/" . $_GET['tabel'];

//    $api = "http://b-edo.uzautomotors.com/api/employees/get-employee2/".$_GET['tabel'];
//    $api2 = "http://b-edo.uzautomotors.com/api/getParentDepartment/".$_GET['tabel'];

$sFile = file_get_contents($api);
//$employeeDepartment = file_get_contents($api2);
$employeeData = json_decode($sFile);
//$employeeDataDecode = json_decode($employeeDepartment);
//$model->date_of_birth = date($employeeData->born_date);

?>

<div class="vaccine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tb_number')->textInput(['maxlength' => true,'value' => $employeeData->tabel]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true,'value' => $employeeData->firstname_uz_latin . ' ' . $employeeData->lastname_uz_latin . ' ' . $employeeData->middlename_uz_latin]) ?>

    <?= $form->field($model, 'birth_day')->textInput(['value'=>$employeeData->born_date]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
