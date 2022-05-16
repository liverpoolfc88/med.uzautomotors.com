<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReportData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="report-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullname',
            'tabel',
            'department_code',
            'profession',
            'date_of_birth',
            'home_address',
            'phone',
            'diagnosis',
            'date_informed',
            'complain',
            'date_analys_taken',
            'date_analys_result',
            'tah_taken_instution',
            'created_by',
            'datetime',
        ],
    ]) ?>

</div>
