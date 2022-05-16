<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportData */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

if ($model->isNewRecord):
    $api = "http://b-edo.uzautomotors.com/api/get-all-employees/" . $_GET['tabel'];
    $api2 = "http://b-edo.uzautomotors.com/api/getParentDepartment/" . $_GET['tabel'];

//    $api = "http://b-edo.uzautomotors.com/api/employees/get-employee2/".$_GET['tabel'];
//    $api2 = "http://b-edo.uzautomotors.com/api/getParentDepartment/".$_GET['tabel'];

    $sFile = file_get_contents($api);
    $employeeDepartment = file_get_contents($api2);
    $employeeData = json_decode($sFile);
    $employeeDataDecode = json_decode($employeeDepartment);
    $model->date_of_birth = date($employeeData->born_date);

    ?>
    <style>
        .datepicker {
            /*color: red;*/
            width: 100%;
        }
    </style>

    <div class="report-data-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'fullname')->textInput(['maxlength' => true, 'value' => $employeeData->firstname_uz_latin . ' ' . $employeeData->lastname_uz_latin . ' ' . $employeeData->middlename_uz_latin]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'tabel')->textInput(['maxlength' => true, 'value' => $employeeData->tabel]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'department_code')->textInput(['value' => $employeeData->department_code]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'profession')->textInput(['maxlength' => true, 'value' => $employeeData->profession . ' (' . $employeeData->name_uz_latin . ')']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'date_of_birth')->input('date', ['data-date' => '', 'data-date-format' => "DD MM YYYY"]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'home_address')->textInput(['maxlength' => true, 'value' => $employeeData->home_address]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>


            <div class="col-md-4">
                <?= date("m.d.y") ?>

                <!--            --><? //= $form->field($model, 'date_informed')->input('date',['value' => date('dd-mm-yyyy')])
                ?>
                <!--            --><? //= $form->field($model, 'date_informed')->input('date',['dateFormat' => (['dd-mm-yyyy','value'=>'date("dd-mm-yyyy")'])])
                ?>
                <?= $form->field($model, 'date_informed')->input('date', ['dateFormat' => ('dd-mm-yyyy'), 'class' => 'datepicker']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'complain')->textInput(['maxlength' => true]) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'diagnosis')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'date_analys_taken')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'date_analys_result')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <?= $form->field($model, 'tah_taken_instution')->textInput(['maxlength' => true]) ?>
            </div>
            <?php
            if ($model->isNewRecord):
                $api2 = "http://b-edo.uzautomotors.com/api/getParentDepartment/" . $_GET['tabel'];
                $employeeDepartment = file_get_contents($api2);
                $employeeDataDecode = json_decode($employeeDepartment);
            endif;
            ?>
            <div class="col-md-4" style="display: none">
                <?= $form->field($model, 'parent_department_id')->textInput(['maxlength' => true, 'value' => $employeeDataDecode->department_code]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'parent_department_name')->textInput(['maxlength' => true, 'value' => $employeeDataDecode->name_uz_latin, 'readonly' => true]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'tahlil_result')
                    ->dropDownList([
                        'mavjud_emas' => 'Mavjud emas',
                        'Manfiy' => 'Manfiy',
                        'Musbat' => 'Musbat',
                        'Gumon' => 'Gumon',
                        'Qayta_tahlilga' => 'Qayta tahlilga',
                        'Tahlil_kutilmoqda' => 'Tahlil kutilmoqda',
                    ]) ?>
            </div>

        </div>


        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php else : ?>


<div class="report-data-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fullname')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'tabel')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'department_code')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'profession')->textInput() ?>
        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'date_of_birth')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'home_address')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'date_informed')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'complain')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'diagnosis')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'date_analys_taken')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'date_analys_result')->input('date', ['dateFormat' => 'dd-mm-yyyy']) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'tah_taken_instution')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'is_cured')->dropDownList([
                0 => 'Hozirda bemor',
                1 => 'Sog\'aydi',
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'tahlil_result')
                ->dropDownList([
                    'mavjud_emas' => 'Mavjud emas',
                    'Manfiy' => 'Manfiy',
                    'Musbat' => 'Musbat',
                    'Gumon' => 'Gumon',
                    'Qayta_tahlilga' => 'Qayta tahlilga',
                    'Tahlil_kutilmoqda' => 'Tahlil kutilmoqda',
                ]) ?>
        </div>


    </div>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php endif; ?>
    <script>
        var $datepicker = $('.datepicker');
        $datepicker.value = Date.now();
        $datepicker.datepicker('setDate', new Date());
        // $(".datepicker").each(function() {
        //     $(this).datepicker('setDate', $(this).val());
        // });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function () {
            var name = $("input#reportdata-profession").val();
            var re = '#';
            var rename = name.replace(re, '-');
            $("input#reportdata-profession").val(rename);
            // alert(rename);
        })
    </script>
<!--    $("b.sum" + title).html(sum);-->
<!--    var re = /яблоки/gi;-->
<!--    var str = 'Яблоки круглые и яблоки сочные.';-->
<!--    var newstr = str.replace(re, 'апельсины');-->
<!--    console.log(newstr); // апельсины круглые и апельсины сочные.-->