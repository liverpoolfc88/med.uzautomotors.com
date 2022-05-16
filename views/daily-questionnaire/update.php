<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailyQuestionnaire */

$this->title = 'Update Daily Questionnaire: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daily Questionnaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="daily-questionnaire-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
