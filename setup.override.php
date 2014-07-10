<?php

include_once('common.inc.php');

/*@var EnviromentSingltone */
$env = EnviromentSingltone::getInstance();

$env->setValue('HTTP_BASE'          ,'http://ubuntu.bit/');
$env->setValue('title'              ,'ООО АвтоТехСнаб - Ваш поставщик запчастей');

$env->setValue('syslog_alias'       ,'atc58');
$env->setValue('log_server'         ,'/var/log/trade_core/server.log');


$env->setValue('db',array(
  'host' => 'localhost',
  'port' => '27017',
  'user' => 'atc58',
  'pass' => 'a2s3d4f5g6',
  'db'   => 'atc58')
);
