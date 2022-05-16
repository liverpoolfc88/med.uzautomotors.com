<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Xozirgi Musbatlar';
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
<section>
    <div class="container">
        <div class="row">
            <div>
                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Tr</th>
                        <th>Tabel</th>
                        <th>FIO</th>
                        <th>Tug'ilgan vaqti</th>
                        <th style="width: 20%">Manzili</th>
                        <th>Telefoni</th>
                        <th>Bo`limi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($musbatnaw as $key =>$mus): ?>
<!--                    <tr>-->
<!--                        <td>Dom</td>-->
<!--                        <td>6000</td>-->
<!--                    </tr>-->
                    <tr class="active-row">
                        <td><?=$key+1?></td>
                        <td><?=$mus->tabel?></td>
                        <td><?=$mus->fullname?></td>
                        <td><?=$mus->date_of_birth?></td>
                        <td><?=$mus->home_address?></td>
                        <td><?=$mus->phone?></td>
                        <td><?=$mus->prod->dep_name?></td>
                    </tr>
                    <? endforeach;?>
                    <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
