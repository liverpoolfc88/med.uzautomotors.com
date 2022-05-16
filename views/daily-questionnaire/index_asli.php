<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DailyQuestionnaireSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kunlik hisobotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="daily-questionnaire-index" style="margin: 25px">
    <span style="cursor: pointer" class="btn btn-info pull-right" onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>

    <h1><?= Html::encode($this->title) ?></h1>

    <input class="form-control" id="myInput" type="text" placeholder="Izlang..">
    <br>

    <table id="dataExport" class="table table-striped">
        <thead>
        <tr>

            <th>Tabel raqami</th>
            <th>Ish sharifi</th>
            <th>Holati</th>
            <th>Hozir qayerda</th>
            <th>So'ngi tahlil natijasi</th>
            <th>ishga chiqadigon sana</th>
            <th>Sana</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php foreach ($employees as $emp): ?>
        <?php $tahlilResult = \app\models\DailyQuestionnaire::find()->where(['tabel'=>$emp->tabel])->orderBy('id DESC')->one(); ?>
        <tr>
            <td><?=$emp->tabel?></td>
            <td><?=$emp->fullname?></td>
            <td><?=$tahlilResult->case?></td>
            <td><?=$tahlilResult->present_location?></td>
            <td><?=$emp->tahlil_result?></td>
            <td><?=$emp->ishga_chiqish_sanasi?></td>
            <?php if(!empty($tahlilResult->date)): ?>
            <td><?=date('d-m-Y H:i',$tahlilResult->date)?></td>
            <?php else : ?>
                <td><?=$emp->datetime?></td>
            <?php endif; ?>
            <td>
                <a href="<?=\yii\helpers\Url::to(['create','tabel'=>$emp->tabel])?>">
                    <button class="btn btn-primary">Kunlik ma'lumot kiritish</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>


</div>
<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>