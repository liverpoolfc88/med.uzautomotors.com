<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportData */

$this->title = 'Yangi med hisobot kiritish';
$this->params['breadcrumbs'][] = ['label' => 'Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
