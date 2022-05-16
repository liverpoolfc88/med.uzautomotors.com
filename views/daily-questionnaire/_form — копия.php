<?php
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Бош саҳифа';

//echo "<pre>";
//print_r($pages);
//echo "</pre>";

if(Yii::$app->session->hasFlash('success-password'))
{?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=Yii::$app->session->getFlash('success-password')?>
    </div>
<?}?>

<div class="site-index">
    <h4 style="text-align: center;"><?=Yii::$app->params['full_sitename']?>нинг маълумотлар порталига</h4>
    <h3 style="text-align: center;margin-bottom: 20px;">ХУШ КЕЛИБСИЗ</h3>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-question"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Кўрсатмалар</span>
                    <span class="info-box-number"><?=$count['all']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Жараёнда</span>
                    <span class="info-box-number"><?=$count['in_process']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Очиқ</span>
                    <span class="info-box-number"><?=$count['open']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ёпиқ</span>
                    <span class="info-box-number"><?=$count['close']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Сўнгги кўрсатмалар</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?=$pages->totalCount . " та маълумотдан ".($pages->pageSize * $pages->page + 1)."-дан ".($pages->pageSize * $pages->page + count($latest))."-гача кўрсатилди.";?>
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Кўрсатма рақами</th>
                                <th width="35%">Бўлим</th>
                                <th>Холати</th>
                                <th>Ким томонидан</th>
                                <th>Киритилган вақт</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
                            $i = $pages->pageSize * $pages->page;
                            foreach($latest as $lItem){
                                $i++;
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><a href="<?=Yii::$app->params['urlOfSite']?>/issues/generate-pdf?id=<?=$lItem->is_id?>" target = "_blank"><?=$lItem->is_regcode?></a></td>
                                    <td><?=mb_substr($lItem->isDp->dp_name,0,200)?></td>
                                    <td>
                                        <?
                                        switch ($lItem->doc_status) {
                                            case 'open' : $l = 'Очиқ'; $c = 'danger'; break;
                                            case 'inProcess' : $l = 'Жараён кетяпти'; $c = 'warning'; break;
                                            case 'close' : $l = 'Ёпилди'; $c = 'success'; break;
                                        }
                                        echo  '<span class="label label-'.$c.'">'.$l.'</span>';
                                        ?>

                                    </td>
                                    <td>
                                        <?
                                        if($lItem->is_owner_id == 1000){
                                            echo '<b>Рахбарият</b>';
                                        }else{
                                            echo  (!is_null($lItem->isOwner->username)) ? $lItem->isOwner->fullname.' ('.$lItem->isOwner->username.')' : '';
                                        }
                                        ?></td>
                                    <td><?=date("d.m.Y H:i", strtotime($lItem->is_created));?></td>
                                    <td><a href="<?=Yii::$app->params['urlOfSite']?>/issues-items/index?IssuesItemsSearch[ii_regcode]=<?=$lItem->is_regcode?>" >кўрсатмалар (<?=count($lItem->issuesItems)?>)</a></td>
                                </tr>
                            <?}?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->


                <div class="box-footer" style="padding-top: 0px;padding-bottom: 0px;">
                    <div class="text-center">
                        <?
                        // display pagination
                        echo LinkPager::widget([
                            'pagination' => $pages,
                            'options' =>[
                                'class' => 'pagination text-center',
                                'style' => 'margin-top:10px;margin-bottom:5px;'
                            ],
                            'prevPageLabel' => 'Олдинги',
                            'nextPageLabel' => 'Кейинги',
                        ]);
                        ?>
                    </div>
                </div>

                <div class="box-footer clearfix">
                    <?if(Yii::$app->user->can('engineer')){?>
                        <a href="<?=Yii::$app->params['urlOfSite']?>/issues/create" class="btn btn-sm btn-info btn-flat pull-left">Хужжат яратиш</a>
                    <?}?>
                    <a href="<?=Yii::$app->params['urlOfSite']?>/issues-items/index" class="btn btn-sm btn-default btn-flat pull-right">Барча муаммолар</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

</div>

