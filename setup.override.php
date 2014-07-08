<?php

include_once('common.inc.php');

/*@var EnviromentSingltone */
$env = EnviromentSingltone::getInstance();

$env->setValue('HTTP_BASE'          ,'http://atc58.ru/');

$env->setValue('syslog_alias'       ,'atc58');
$env->setValue('log_server'         ,'/var/log/trade_core/server.log');


$env->setValue('db',array(
  'host' => 'localhost',
  'port' => '3306',
  'user' => 'atc58',
  'pass' => 'test',
  'db'   => 'atc58')
);
