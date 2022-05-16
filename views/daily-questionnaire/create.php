<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DailyQuestionnaire */

$this->title = 'Bugungi kungi tahlil hisoboti';
$this->params['breadcrumbs'][] = ['label' => 'Daily Questionnaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daily-questionnaire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userData' => $userData,
        'userHistory' => $userHistory,
    ]) ?>

</div>
