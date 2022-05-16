<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DailyQuestionnaireSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kunlik hisobotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        /*text-align: center*/
    }

    .customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .customers tr:nth-child(even){background-color: #f2f2f2;}

    .customers tr:hover {background-color: #ddd;}

    .customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="daily-questionnaire-index" style="margin: 25px">
    <span style="cursor: pointer" class="btn btn-info pull-right" onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>

    <h1><?= Html::encode($this->title) ?></h1>

    <input class="form-control" id="myInput" type="text" placeholder="Izlang..">
    <br>

    <table id="dataExport" class="customers table table-striped">
        <thead>
        <tr>

            <th>Tartib raqam</th>
            <th>Tabel raqami</th>
            <th>Ish sharifi</th>
            <th>Holati</th>
            <th>Hozir qayerda</th>
            <th>So'ngi tahlil natijasi</th>
            <th>ishga chiqadigon sana</th>
            <th>Sana</th>
            <th>
                <select class="form-control" id="mySelect" type="text" placeholder="Izlang..">
                    <option value="0">Tanlang</option>
                    <option>Ishga_chiqdi</option>
                    <option>Vafot_etdi</option>
                    <option>Uyda</option>
                    <option>Shifoxonada</option>
                </select>
            </th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php foreach ($employees as $key=>$emp): ?>
<!--        --><?php //$tahlilResult = \app\models\DailyQuestionnaire::find()->where(['tabel'=>$emp->tabel])->orderBy('id DESC')->one(); ?>
        <?php $tahlilResult = \app\models\DailyQuestionnaire::find()->where(['tabel'=>$emp->tabel])->orderBy('date DESC')->one(); ?>
          <tr>
            <td><?=$key+1?></td>
            <td><?=$emp->tabel?></td>
            <td><?=$emp->fullname?></td>
            <td><?=$tahlilResult->case?></td>
            <td><?=$tahlilResult->present_location?></td>
            <td><?=$emp->tahlil_result?></td>
            <td><?=$emp->ishga_chiqish_sanasi?></td>
            <?php if(!empty($tahlilResult->date)): ?>
            <td><?=date($tahlilResult->date)?></td>
            <?php else : ?>
                <td><?=date($emp->datetime)?></td>
            <?php endif; ?>
            <td>
                <a href="<?=\yii\helpers\Url::to(['create','tabel'=>$emp->tabel])?>">
                    <? if($tahlilResult->present_location == 'Ishga_chiqdi'){?>
                    <button class="btn btn-success">Kunlik ma'lumot kiritish</button>
                    <? } elseif (!isset($tahlilResult->present_location)){?>
                        <button class="btn btn-default">Kunlik ma'lumot kiritish</button>
                     <? } elseif ($tahlilResult->case == 'Vafot_etdi') {?>
                    <button class="btn btn-danger">Kunlik ma'lumot kiritish</button>
                    <?} else { ?>
                    <button class="btn btn-primary">Kunlik ma'lumot kiritish</button>
                    <? } ?>
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
<script>
    $(document).ready(function(){
        $("#mySelect").on("change", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>