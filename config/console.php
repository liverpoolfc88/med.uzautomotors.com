<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
	    'ldap' => [
		    'domain_controllers'    => ['10.142.62.246', '10.142.62.247'],
		   // 'host' => 'ldap.example.com',
		    'port' => '389',
		    'base_dn'               => 'DC=AD,DC=UZAUTOMOTORS,DC=COM',
		    'admin_username'        => 'bitrix_sync',
		    'admin_password'        => 'Bs123456789',
		    'groupDN' => '',
		    //Input your AD login/pass on dev or sys login/pass on test/prod servers
		    'sysUserLogin' => '',
		    'sysUserPassword' => '',
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
