<?php
return [
'class' => 'kosoukhov\ldap\Connector',
'useCache' => YII_ENV_DEV ? false : true,
'host' => '10.142.62.246',
'port' => '3268',
'baseDN' => 'DC=AD,DC=UZAUTOMOTORS,DC=COM',
//Input your AD login/pass on dev or sys login/pass on test/prod servers
'sysUserLogin' => 'bitrix_sync',
'sysUserPassword' => 'Bs123456789',
];

?>