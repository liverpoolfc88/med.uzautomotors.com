<h1 style="text-align: center">Boshqarmalar kesimida  bemorlar</h1>
<span style="cursor: pointer" class="btn btn-info" onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>
<div class="table-responsive">
    <table id="dataExport" class="table table-striped">
        <thead>

        <tr>
            <th rowspan="2" class="vertial center">Boshqarma nomi</th>
            <th rowspan="2" class="vertial center">Jami bemorlar soni</th>
            <th  rowspan="2" class="vertial center">Kunlik <br>murojat</th>
            <th  rowspan="2" class="vertial center">Tahlil olinganlar soni</th>
            <th colspan="6" style="text-align: center">Tahlil natijasi</th>
            <th rowspan="2" class="center">Sog'ayganlar</th>
            <th colspan="5">Holati</th>
            <th colspan="5">Xozirda qayerda</th>
        </tr>
        <tr>
            <th class="center">+</th>
            <th class="center">Gumon</th>
            <th class="center">-</th>
            <th class="center">Qayta tahlilga</th>
            <th class="center">Tahlil kutilmoqda</th>
            <th>Mavjud emas</th>
            <th>Yaxshi</th>
            <th>Yengil</th>
            <th>Og'ir</th>
            <th>O'ta og'ir</th>
            <th>Vafot edi</th>
            <th>Uyda </th>
            <th>Shifoxonada </th>
            <th>Uy karantinida </th>
            <th>Karantinda </th>
            <th>Ishga chiqdi </th>
          
        </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $dep): ?>
            <tr>
                <td><?=$dep->dep_name?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'patientNumber')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'patientDaily')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'tahlil')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'musbat')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Gumon')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Manfiy')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Qayta_tahlilga')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Tahlil_kutilmoqda')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'mavjud_emas')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'case')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Yaxshi')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Yengil')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Ogir')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Ota_ogir')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Vafot_etdi')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Uyda')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Shifoxonada')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Uy_karantinida')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Karantinda')?></td>
                <td><?=\app\models\ProductionLine::generalData($dep->dep_code,'Ishga_chiqdi')?></td>
            </tr>

        <?php endforeach;?>
        <tr>
            <td>Jami:</td>
            <td><?=\app\models\ProductionLine::summary('summaryPatients')?></td>
            <td><?=\app\models\ProductionLine::summary('patientDaily')?></td>
            <td><?=\app\models\ProductionLine::summary('tahlil')?></td>
            <td><?=\app\models\ProductionLine::summary('musbat')?></td>
            <td><?=\app\models\ProductionLine::summary('Gumon')?></td>
            <td><?=\app\models\ProductionLine::summary('Manfiy')?></td>
            <td><?=\app\models\ProductionLine::summary('Qayta_tahlilga')?></td>
            <td><?=\app\models\ProductionLine::summary('Tahlil_kutilmoqda')?></td>
            <td><?=\app\models\ProductionLine::summary('mavjud_emas')?></td>
            <td><?=\app\models\ProductionLine::summary('case')?></td>
            <td><?=\app\models\ProductionLine::summary('Yaxshi')?></td>
            <td><?=\app\models\ProductionLine::summary('Yengil')?></td>
            <td><?=\app\models\ProductionLine::summary('Ogir')?></td>
            <td><?=\app\models\ProductionLine::summary('Ota_ogir')?></td>
            <td><?=\app\models\ProductionLine::summary('Vafot_etdi')?></td>
            <td><?=\app\models\ProductionLine::summary('Uyda')?></td>
            <td><?=\app\models\ProductionLine::summary('Shifoxonada')?></td>
            <td><?=\app\models\ProductionLine::summary('Uy_karantinida')?></td>
            <td><?=\app\models\ProductionLine::summary('Karantinda')?></td>
            <td><?=\app\models\ProductionLine::summary('Ishga_chiqdi')?></td>
        </tr>
        </tbody>
    </table>
</div>

<style>
    .vertial {
        vertical-align: middle;
    }
    th {
        text-align: center;
        background: lightgreen;
    }
    .center {
        text-align: center;
    }
    td,th,table {
        border: 1px solid black;
    }
    td {
        text-align: center;
    }
</style>