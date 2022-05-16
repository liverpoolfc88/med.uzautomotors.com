<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VaccineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vaksina';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vaccine-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>
    <div class="row" style='margin:40px 0 0 20px'>
<!--        --><?php //if (Yii::$app->session->hasFlash('success')): ?>
<!--            <div class="alert alert-warning">-->
<!--                <strong>--><?//= Yii::$app->session->getFlash('success') ?><!--!</strong>-->
<!--            </div>-->
<!--        --><?php //endif; ?>
        <div class="col-md-3">
            <?= $form->field($model, 'tb_number')->textinput(['required'=>true])->label('Xodim tabel raqamini kiriting');?>
        </div>
        <div class="col-md-3 form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'style' => 'margin-top: 25px;']) ?>
        </div>
<!--        <div style="padding-top: 5px" class="col-md-1">-->
<!--            <label for="test"></label>-->
<!--            <button type="submit" class='btn btn-primary'>So'rovni yuborish</button>-->
<!--        </div>-->
    </div>
    <?php ActiveForm::end(); ?>


<!--    <p>-->
<!--        --><?//= Html::a('Create Vaccine', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'tb_number',
            'fullname',
            'birth_day',
//            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
