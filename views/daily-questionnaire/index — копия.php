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
    .customers thead {
        text-align: center !important
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

<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="daily-questionnaire-index" style="margin: 25px">
<!--    <span style="cursor: pointer" class="btn btn-info pull-right" onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>-->
    <span style="cursor: pointer" class="btn btn-info pull-right" onclick="exportTableToExcel('tblData')" href="">
        Tablitsani export qilish
    </span>
<!--    <a  class="btn btn-primary" onclick="exportTableToExcel('tblData')" href="">EXELGA KO'CHIRISH</a>-->
    <h1><?= Html::encode($this->title) ?></h1>

    <input class="form-control" id="myInput" type="text" placeholder="Izlang..">
    <br>

<!--    <table id="dataExport" class="customers table table-striped">-->
    <table id="tblData" class="customers table table-striped">
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
<!--        <tbody id="myTable">-->
        <tbody>
        <?php foreach ($employees as $key=>$emp): ?>
        <?php $tahlilResult = \app\models\DailyQuestionnaire::find()->where(['tabel'=>$emp->tabel])->orderBy('id DESC')->one(); ?>
        <tr  <?=($tahlilResult->present_location == 'Ishga_chiqdi')?' style="background-color: #0b97c4; color: white"':''?>
        >
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
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#myInput").on("keyup", function() {-->
<!--            var value = $(this).val().toLowerCase();-->
<!--            $("#myTable tr").filter(function() {-->
<!--                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->