<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\DailyQuestionnaire */
/* @var $form yii\widgets\ActiveForm */
$data = \app\models\ReportData::findOne(['tabel'=>$_GET['tabel']]);
$model->ishga_chiqish_sanasi = $data->ishga_chiqish_sanasi;
?>
<div class="row">
    <div class="col-md-8">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'tahlil_result')
                    ->dropDownList([
                        'mavjud_emas'=>'Mavjud emas',
                        'Manfiy' => 'Manfiy',
                        'Musbat' => 'Musbat',
                        'Gumon' => 'Gumon',
                        'Qayta_tahlilga' => 'Qayta tahlilga',
                        'Tahlil_kutilmoqda' => 'Tahlil kutilmoqda',

                    ]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'case') ->dropDownList([
                    'Yaxshi' => 'Yaxshi',
                    'Yengil' => 'Yengil',
                    'Ogir' => 'O\'gir',
                    'Ota_ogir' => 'O\'ta og\'ir',
                    'Vafot_etdi' => 'Vafot etdi',
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'present_location')->dropDownList([
                    'Uyda' => 'Uyda',
                    'Shifoxonada'=>'Shifoxonada',
                    'Uy_karantinida'=>'Uy karantinida',
                    'Karantinda'=>'Karantinda',
                    'Ishga_chiqdi'=>'Ishga chiqdi',
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'kasallik_caraqa') ->dropDownList([
                    'Xa' => 'Xa',
                    'Yo\'q' => 'Yo\'q',
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'ishga_chiqish_sanasi')->input('date') ?>
<!--                --><?//=DateTimePicker::widget([
//                    'name' => 'ishga_chiqish_sanasi',
//                    'options' => ['placeholder' => 'Select operating time ...'],
//                    'convertFormat' => true,
//                    'pluginOptions' => [
//                        'format' => 'Y-m-d H:i:s',
////                        'startDate' => '01-Mar-2014 12:00 AM',
//                        'todayHighlight' => true
//                    ]])
//                ?>
            </div>
        </div>
        <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>


        <div class="form-group">
            <?= Html::submitButton('Ma\'lumotni saqlash', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Bosh sahifaga qaytish', ['index'], ['class'=>'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>


        <?php if(count($userHistory)>0): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Tahlil natijasi</th>
                <th>Xolati</th>
                <th>Xozirda qayerda</th>
                <th>Kasallik varaqasi</th>
                <th>Izoh</th>
                <th>Sana</th>
            </tr>
            </thead>
            <tbody>
          <?php foreach ($userHistory as $emp): ?>
            <tr>
                <td><?=$emp->tahlil_result?></td>
                <td><?=$emp->case?></td>
                <td><?=$emp->present_location?></td>
                <td><?=$emp->kasallik_caraqa?></td>
                <td><?=$emp->desc?></td>
<!--                <td>--><?//=date('d-m-Y',$emp->date)?><!--</td>-->
                <td><?=$emp->date?></td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <?php endif?>
    </div>
    <div class="col-md-4">
        <table class="table table-striped">
            <thead>

            </thead>
            <tbody>
            <tr>
                <td>Ism sharifi</td>
                <td><?=$userData->fullname ?></td>

            </tr>
            <tr>
                <td>Tabel raqami</td>
                <td><?=$userData->tabel ?></td>
            </tr>

            <tr>
                <td>Bo'lim raqami</td>
                  <td><?=$userData->department_code ?></td>

            </tr>
            <tr>
                <td>Lavozimi</td>
                  <td><?=$userData->profession ?></td>

            </tr>
            <tr>
                <td>Tug'ilgan sanasi</td>
                  <td><?=$userData->date_of_birth ?></td>

            </tr>
            <tr>
                <td>Uy manzili</td>
                  <td><?=$userData->home_address ?></td>
            </tr>

            <tr>
                <td>Telefon raqami</td>
                  <td><?=$userData->phone ?></td>
            </tr>

            <tr>
                <td>Tashxisi</td>
                  <td><?=$userData->diagnosis ?></td>
            </tr>

            <tr>
                <td>Murojat qilgan sana</td>
                  <td><?=$userData->date_informed ?></td>
            </tr>

            <tr>
                <td>Shikoyati</td>
                  <td><?=$userData->complain ?></td>
            </tr>

            <tr>
                <td>Tahlil olingan sana</td>
                  <td><?=$userData->date_analys_taken ?></td>
            </tr>

            <tr>
                <td>Tahlil natijasi chiqgan sana</td>
                  <td><?=$userData->date_analys_result ?></td>
            </tr>

            <tr>
                <td>So'ngi tahlil natijasi</td>
                <td><?=$userData->tahlil_result ?></td>
            </tr>

            <tr>
                <td>Ishga chiqadigon sana</td>
                <td><?=$userData->ishga_chiqish_sanasi ?></td>
            </tr>

            <tr>
                <td>Tahlil olingan muassasa</td>
                <td><?=$userData->tah_taken_instution ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="daily-questionnaire-form">

</div>
