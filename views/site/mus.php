<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Musbatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }
    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }
    thead th {
        border: white solid 1px;
    }
</style>
<!---->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<section>
    <div class="container-fluid">
        <div style="padding-top: 20px" class="row">
            <span style="cursor: pointer; margin-bottom: 20px" class="btn btn-info pull-right" onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>
            <input class="form-control" id="myInput" type="text" placeholder="Izlang..">
        </div>
        <div class="row">

            <div>
                <table id="dataExport" class="styled-table">
                    <thead>
                    <tr>
                        <th>Tr</th>
                        <th>Tabel</th>
                        <th>FIO</th>
                        <th>Tug'ilgan vaqti</th>
                        <th style="width: 20%">Manzili</th>
                        <th>Telefoni</th>
                        <th>Lavozimi</th>
                        <th>Bo`limi</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <? foreach ($musbat as $key =>$mus): ?>
<!--                    <tr>-->
<!--                        <td>Dom</td>-->
<!--                        <td>6000</td>-->
<!--                    </tr>-->
                    <tr class="active-row">
                        <td><?=$key+1?></td>
                        <td><?=$mus->tabel?></td>
                        <td><?=$mus->dep->fullname?></td>
                        <td><?=$mus->dep->date_of_birth?></td>
                        <td><?=$mus->dep->home_address?></td>
                        <td><?=$mus->dep->phone?></td>
                        <td><?=$mus->dep->profession?></td>
                        <td><?=$mus->dep->prod->dep_name?></td>
                    </tr>
                    <? endforeach;?>
                    <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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