<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
	$action = Yii::$app->controller->id;
	$controlleraction = Yii::$app->controller->action->id;
$role = Yii::$app->user->identity->role;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=Url::to(['site/'])?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->

            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>UzAuto Motors MED</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <? if (!Yii::$app->user->isGuest): ?>
                        <a data-method="post" href="<?=Url::to(['site/logout'])?>">
                           Chiqish
                        </a>
                        <? else: ?>
                            <a data-method="post" href="<?=Url::to(['site/login'])?>">
                                Kirish
                            </a>
                        <? endif; ?>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>

                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->

                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=Yii::$app->homeUrl;?>images/profile.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?=Yii::$app->user->identity->fullname?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Aktiv</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>


            <ul class="sidebar-menu" data-widget="tree">

                <li class="<?=($action=='site')?'active':''?>">
                    <a href="<?= Url::to(['site/'])?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Asosiy</span>
                    </a>
                </li>

	            <li class="<?=($action=='user')?'active':''?>">
                    <a href="<?= Url::to(['site/asosiy'])?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Umumiy ma'lumotlar</span>
                    </a>
                </li>
                <? if (!Yii::$app->user->isGuest): ?>
                <li class="<?=($action=='user')?'active':''?>">
                    <a href="<?= Url::to(['report-data/'])?>">
                        <i class="fa fa-users"></i>
                        <span>Yangi bemor</span>
                    </a>
                </li>

                <li class="<?=($action=='user')?'active':''?>">
                    <a href="<?= Url::to(['daily-questionnaire/'])?>">
                        <i class="fa fa-users"></i>
                        <span>Kunlik xisobot kiritish</span>
                    </a>
                </li>
                <li class="<?=($action=='vaccine')?'active':''?>">
                    <a href="<?= Url::to(['vaccine/'])?>">
                        <i class="fa fa-users"></i>
                        <span>Vaksina</span>
                    </a>
                </li>

		            <li class="<?=($action=='user')?'active':''?>">
			            <a href="<?= Url::to(['user/'])?>">
				            <i class="fa fa-users"></i>
				            <span>Foydalanuvchilar</span>
			            </a>
		            </li>
                <? endif; ?>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>
    <style>
        .xa {
            background-color: white;
        }
    </style>
    <? if ($action=='site' && $controlleraction=='index'){?>
        <div class="content-wrapper xa">
            <div class="container-fluid"">
                <?= $content ?>
            </div>
        </div>
   <? } else {?>
    <div class="content-wrapper">
        <div class="container" style="width: 90%">
        <?= $content ?>
        </div>
    </div>
    <?}?>
    <script>
        function exportTableToExcel(tableID, filename = 'umumiy_statistikalar'){
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
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
