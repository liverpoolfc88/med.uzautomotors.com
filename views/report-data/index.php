<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="report-data-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row" style='margin:40px 0 0 20px'>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-warning">
                <strong><?= Yii::$app->session->getFlash('success') ?>!</strong>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <?= $form->field($model, 'tabelCheck')->textinput()->label('Xodim tabel raqamini kiriting');?>
        </div>
        <div class="col-md-1">
            <label for="test"></label>
            <button class='btn btn-primary'>So'rovni yuborish</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>







    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fullname',
            'tabel',
            'department_code',
            'profession',
            //'date_of_birth',
            //'home_address',
            //'phone',
            //'kasallik_varaqa',
            //'diagnosis',
            //'date_informed',
            //'complain',
            //'date_analys_taken',
            //'date_analys_result',
            //'tah_taken_instution',
            //'created_by',
            //'datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
