<?

use yii\helpers\Url;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<h1 style="text-align: center">Boshqarmalar kesimida bemorlar</h1>
<span style="cursor: pointer;margin-bottom: 20px" class="btn btn-info pull-right"
      onclick="exportTableToExcel('dataExport')">Tablitsani export qilish </span>
<div style="clear: both"></div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <a target="_blank" href="<?= Url::to(['/site/mus']) ?>"><span class="info-box-icon bg-yellow "><i class="fa fa-calendar-plus-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Covid-19</span>
                    <span class="info-box-text">aniqlanganlar </span>
<!--                    <span class="info-box-number">--><?//= $countMusbat ?><!-- nafar</span>-->
                    <span id="musbat" class="info-box-number"></span>
                </div>
            </a>

            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <a href=""><span class="info-box-icon bg-green"><i class="fa fa-child "></i></span>
<!--            --><?// $dav = \app\models\ReportData::summary('musbat') ?>
            <div class="info-box-content">
                <span class="info-box-text">Covid-19</span>
                <span class="info-box-text">Tuzalganlar</span>
<!--                <span class="info-box-number">--><?//= $countMusbat - $dav ?><!-- nafar</span>-->
                <span id="tuz" class="info-box-number"></span>
                <!--                <span class="info-box-number">--><? //=$countManfiy?><!-- nafar</span>-->
            </div>
            </a>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <a target="_blank" href="<?= Url::to(['/site/musnaw']) ?>"> <span class="info-box-icon bg-aqua "><i class="fa fa-bed"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Covid-19</span>
                <span class="info-box-text">Davolanayotganlar</span>
<!--                <span class="info-box-number">--><?//= $dav - $died ?><!-- nafar</span>-->
                <span id="musbatnaw" class="info-box-number"></span>
            </div>
            </a>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <a target="_blank" href="<?= Url::to(['/site/died']) ?>"><span class="info-box-icon bg-red "><i class="fa fa-window-close"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Covid-19</span>
                <span class="info-box-text">Vafot etganlar</span>
<!--                <span class="info-box-number">--><?//= $died ?><!-- nafar</span>-->
                <span id="ulgan" class="info-box-number"></span>
                <!--                <span class="info-box-number">--><? //=$not_employed?><!-- nafar</span>-->
            </div>
            </a>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="table-responsive">
    <table id="dataExport" class="table table-striped">
        <thead>

        <tr>
            <th rowspan="2" class="vertial center">Boshqarma nomi</th>
            <th rowspan="2" class="vertial center">Boshqarma kodi</th>
            <th rowspan="2" class="vertial center">Jami bemorlar soni</th>
            <th rowspan="2" class="vertial center">Kunlik <br>murojat</th>
            <th rowspan="2" class="vertial center">Tahlil olinganlar soni</th>
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
            <th>Uyda</th>
            <th>Shifoxonada</th>
            <th>Uy karantinida</th>
            <th>Karantinda</th>
            <th>Ishga chiqdi</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $dep): ?>
            <tr>
                <?php if ($dep->dep_code == 32000000): ?>

                    <td>
                        <a target="_blank" href="<?= \yii\helpers\Url::to(['production-line']) ?>">
                            <?= $dep->dep_name ?>
                        </a>
                    </td>
                <?php else : ?>
                    <td><?= $dep->dep_name ?></td>
                <?php endif ?>
                <td><?= $dep->dep_code ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'patientNumber') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'patientDaily') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'tahlil') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'musbat') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Gumon') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Manfiy') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Qayta_tahlilga') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Tahlil_kutilmoqda') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'mavjud_emas') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'case') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Yaxshi') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Yengil') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Ogir') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Ota_ogir') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Vafot_etdi') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Uyda') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Shifoxonada') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Uy_karantinida') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Karantinda') ?></td>
                <td><?= \app\models\ReportData::generalData($dep->dep_code, 'Ishga_chiqdi') ?></td>
            </tr>

        <?php endforeach; ?>
        <tr>
            <td colspan="2">Jami:</td>

            <td><?= \app\models\ReportData::summary('summaryPatients') ?></td>
            <td><?= \app\models\ReportData::summary('patientDaily') ?></td>
            <td><?= \app\models\ReportData::summary('tahlil') ?></td>
            <td><?= \app\models\ReportData::summary('musbat') ?></td>
            <td><?= \app\models\ReportData::summary('Gumon') ?></td>
            <td><?= \app\models\ReportData::summary('Manfiy') ?></td>
            <td><?= \app\models\ReportData::summary('Qayta_tahlilga') ?></td>
            <td><?= \app\models\ReportData::summary('Tahlil_kutilmoqda') ?></td>
            <td><?= \app\models\ReportData::summary('mavjud_emas') ?></td>
            <td><?= \app\models\ReportData::summary('case') ?></td>
            <td><?= \app\models\ReportData::summary('Yaxshi') ?></td>
            <td><?= \app\models\ReportData::summary('Yengil') ?></td>
            <td><?= \app\models\ReportData::summary('Ogir') ?></td>
            <td><?= \app\models\ReportData::summary('Ota_ogir') ?></td>
            <td><?= \app\models\ReportData::summary('Vafot_etdi') ?></td>
            <td><?= \app\models\ReportData::summary('Uyda') ?></td>
            <td><?= \app\models\ReportData::summary('Shifoxonada') ?></td>
            <td><?= \app\models\ReportData::summary('Uy_karantinida') ?></td>
            <td><?= \app\models\ReportData::summary('Karantinda') ?></td>
            <td><?= \app\models\ReportData::summary('Ishga_chiqdi') ?></td>
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

    td, th, table {
        border: 1px solid black;
    }

    td {
        text-align: center;
    }
</style>
<script>
    $(function () {
        // $(function () {
        //     alert('sasas');
        $.get("/site/countasosiy", {json: 'ok'}, function (response) {
            if (response){
                let died = response.died;
                let musbat = response.musbat;
                let musbatnaw = response.musbatnaw;
                let tuz = musbat-(musbatnaw+died)
                $("#musbat").html(musbat+' nafar');
                $("#ulgan").html(died+' nafar');
                $("#musbatnaw").html(musbatnaw+' nafar');
                $("#tuz").html(tuz+' nafar');
                console.log(response);
            }
        })
        // })
    })
</script>