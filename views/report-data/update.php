<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportData */

$this->title = 'Update Report Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="report-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
