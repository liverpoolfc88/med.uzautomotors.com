<?php
	/* @var $this yii\web\View */
	/* @var $form yii\bootstrap\ActiveForm */
	/* @var $model \app\models\LoginForm */

	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;

	$this->title = Yii::t('app', 'Login');
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="margin-top:100px">

	<div class="col-md-12 bs-component">
		<p style="width: 500px; margin: auto; text-align: center;"><img src="<?=Yii::$app->homeUrl?>img/uzautomotors.jpg" height="60" /></p>
		<h2 class='text-center' style="color: #025894;">med.uzautomotors.com</h2>




		<!-- <div class="alert alert-info" role="alert" style="width: 500px; margin: 30px auto;"> <strong> <i class="glyphicon glyphicon-exclamation-sign"></i> Диққат!</strong> Тизимга домен орқали(яъни компьютерингиз логин пароли билан) киришингиз мумкин.</div> -->





		<div class="panel panel-primary" style="width: 500px; margin: 30px auto;">
			<div class="panel-heading" style="text-align: center;"><span style="font-size: 18px;">Авторизация</span></div>
			<div class="panel-body">

				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

				<?= $form->field($model, 'username')->textInput(
					['placeholder' => Yii::t('app', 'Логин'), 'autofocus' => true])->label('Логин') ?>


				<?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Парол')])->label('Парол') ?>

				<?//= $form->field($model, 'rememberMe')->checkbox() ?>



				<div class="form-group pull-right">
					<?= Html::submitButton('<i class="glyphicon glyphicon-log-in"></i>  ' . Yii::t('app', 'войти в систему  '), ['class' => 'btn btn-primary btn-sm', 'name' => 'login-button']) ?>
				</div>

				<?php ActiveForm::end(); ?>
			</div>

		</div>
		<!--
		<div class="alert alert-info" role="alert" style="width: 500px; margin: 30px auto;">
		<strong> <i class="glyphicon glyphicon-exclamation-sign"></i> <a href="" style="color:#000000">Тизимдан фойдаланиш учун йўриқнома</a> </div>
		-->

		<!-- Contextual button for informational alert messages -->


	</div>

</div>

<style>
	html,
	body {
		text-rendering: optimizeLegibility !important;
		-webkit-font-smoothing: antialiased !important;
		height: 100%;
	}

	.wrap {
		min-height: 100%;
		height: auto;
		margin: 0 auto -60px;
		padding: 0 0 60px;
	}

	.wrap > .container {
		padding: 70px 15px 20px;
	}

	.jumbotron {
		text-align: center;
		border: 1px solid #e5e5e5;
	}

	.jumbotron .btn {
		font-size: 21px;
		padding: 14px 24px;
	}

	.footer {
		height: 60px;
		border-top: 1px solid #e5e5e5;
		padding-top: 20px;
		font-size: 12px;
	}

	.not-set {
		color: #c55;
		font-style: italic;
	}

	/* add sorting icons to gridview sort links */
	a.asc:after, a.desc:after {
		position: relative;
		top: 1px;
		display: inline-block;
		font-family: 'Glyphicons Halflings';
		font-style: normal;
		font-weight: normal;
		line-height: 1;
		padding-left: 5px;
	}

	a.asc:after {
		content: "\e151";
	}

	a.desc:after {
		content: "\e152";
	}

	.sort-numerical a.asc:after {
		content: "\e153";
	}

	.sort-numerical a.desc:after {
		content: "\e154";
	}

	.sort-ordinal a.asc:after {
		content: "\e155";
	}

	.sort-ordinal a.desc:after {
		content: "\e156";
	}

	.grid-view td {
		white-space: nowrap;
	}

	.grid-view .filters input,
	.grid-view .filters select {
		min-width: 50px;
	}

	.grid-view td:last-child {
		width: 68px;
	}

	.hint-block {
		display: block;
		margin-top: 5px;
		color: #999;
	}

	.error-summary {
		color: #a94442;
		background: #fdf7f7;
		border-left: 3px solid #eed3d7;
		padding: 10px 20px;
		margin: 0 0 15px 0;
	}

	/* add red asterisk to required form fields */
	div.required label:after {
		content: " *";
		color: #e13431;
	}

	/*-- Css for nicer display of boolean yes/no values --*/

	.boolean-true {
		font-weight: bold;
		color: green;
	}

	.boolean-false {
		font-weight: bold;
		color: #e13431;
	}

	/*-- Css for nicer display of user roles --*/

	.role-theCreator {
		font-weight: bold;
		color: black;
	}

	.role-admin {
		font-weight: bold;
		color: #c4a500;
	}

	.role-employee {
		font-weight: bold;
		color: #800080;
	}

	.role-premium {
		font-weight: bold;
		color: #009d00;
	}

	.role-member {
		font-weight: bold;
		color: #4c4cff;
	}

	/*-- Password strength --*/

	/* Ajust the size so it fits nicely */
	.kv-meter-container {
		width: 105px;
	}

	/*.table{
			table-layout: fixed;
	}*/
</style>
