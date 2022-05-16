
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=\app\models\Vaccine::find()->count()?></h3>

                    <p>Vaksina olganlar</p>
                </div>
                <div class="icon">
                    <i class="ion  ion-person-add"></i>
                </div>
                <a class="small-box-footer">Vaksina olganlar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=\app\models\ReportData::summary('tahlil')?></h3>

                    <p>Tahlil olinganlar soni</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-archive"></i>
                </div>
                <a class="small-box-footer">Tahlil olinganlar soni <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=\app\models\ReportData::summary('patientDaily')?></h3>

                    <p>Kunlik murojaat</p>
                </div>
                <div class="icon">
                    <i class="ion  ion-person-add"></i>
                </div>
                <a class="small-box-footer">Kunlik murojaat <i class="fa fa-arrow-circle-right"></i></a>
<!--                <div class="inner">-->
<!--                    <h3>--><?//=\app\models\ReportData::summary('Tahlil_kutilmoqda')?><!--</h3>-->
<!---->
<!--                    <p>Kutilayotgan tahlillar</p>-->
<!--                </div>-->
<!--                <div class="icon">-->
<!--                    <i class="ion ion-stats-bars"></i>-->
<!--                </div>-->
<!--                <a class="small-box-footer">Kutilayotgan tahlillar <i class="fa fa-arrow-circle-right"></i></a>-->
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?=\app\models\ReportData::summary('summaryPatients')?></h3>

                    <p>Jami kasallar soni</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a  class="small-box-footer">Jami kasallar soni <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
   
    <section  class="content">
        <div style="background-color: #663399 !important;" class="callout callout-warning">
        	<div class="row">
        		<div class="col-md-6">
            		<h1>Уйда қолиб, биз<br>Covid-19 ни мағлуб этамиз!</h1>        			
        		</div>
        		<div align="center" class="col-md-6">
        			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  
					    <div class="carousel-inner">
					      <div class="item active">
					        <img src="/themes/img/4.jpg" alt="Los Angeles" style="height: 100px">
					      </div>

					      <div class="item">
					        <img src="/themes/img/5.jpg" alt="Chicago" style="height: 100px">
					      </div>
					    
					      <div class="item">
					        <img src="/themes/img/6.jpg" alt="New york" style="height: 100px">
					      </div>
					    </div>

  					</div>
        		</div>
        	</div>
	


        </div>


        <div class="row">
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">BOSHQARMALAR KESIMIDA</h3>
                        <h5 class="box-title" style="font-size: small"><?=$array2[0]->name.'da <b>'.$array2[0]->a.'</b> nafar'?></h5>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="bar-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->



            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">


                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">COVID-19 UMUMIY NATIJA</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

    </section>
</section>

<script src="/themes/bower_components/jquery/dist/jquery.min.js"></script>

<script src="/themes/bower_components/morris.js/morris.min.js"></script>

<script>
    $(function () {
        "use strict";




        // DONUT CHART
        // var arr_count = [];
        // $.get('/site/array-count',function(e){
        //     arr_count = JSON.parse(e);
        //     console.log(arr_count);
        // });
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: [ "#FF1493","#00BFFF", "#4B0082"],
            data: <?=$array_count?>,

            hideHover: 'auto',

        });
        // console.log(arr_count);
        //BAR CHART

        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: <?=$array?>,
            // data:
            //
            //     [
            //     {y: '2006', a: 100, b: 90},
            //     {y: '2007', a: 75, b: 65},
            //     {y: '2008', a: 50, b: 40},
            //     {y: '2009', a: 75, b: 65},
            //     {y: '2010', a: 50, b: 40},
            //     {y: '2011', a: 75, b: 65},
            //     {y: '2012', a: 100, b: 90}
            // ],

            // barColors: ['#00a65a', '#f56954'],
            barColors: ['#8A2BE2', '#0000CD'],
            xkey: 'name',
            ykeys: ['a'],
            labels: ['Jami'],
            hideHover: 'auto'
        });
    });
</script>

