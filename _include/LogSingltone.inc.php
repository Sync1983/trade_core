<?php

/*
 * @name Log
 */
class Log {
  /*
   * @var Log
   */
  const SERVER = 1;
  const CLIENT = 2;
  const BILLING = 3;
  
  protected static $_instance;  
  protected static $_syslog_alias;
  protected static $_log_server;
  protected static $_log_client;  
  protected static $_log_billing;
  
  /*
   * @return Log
   */
  public static function getInstance() {
    if(self::$_instance==null) {
      self::$_instance = new Log();
    }
    return self::$_instance;
  }  
  
  public static function sendInfo($type,$message) {
    $prefix = "[INF]".self::_getPrefix($type)." ".$message;
    syslog(LOG_USER, $prefix);
  }
  
  public static function sendDebug($type,$message) {
    $prefix = "[DBG]".self::_getPrefix($type)." ".$message;
    syslog(LOG_USER, $prefix);
  }
  
  public static function sendError($type,$message) {
    $prefix = "[ERR]".self::_getPrefix($type)." ".$message;
    syslog(LOG_USER, $prefix);
  }
  
  private static function _getPrefix($type) {
    $prefix = "[UNKNOW]";
    if($type==self::SERVER) {
      $prefix = "[SERVER]";
    }
    elseif($type==self::CLIENT) {
      $prefix = "[CLIENT]";
    }
    elseif($type==self::CLIENT) {
      $prefix = "[BILLING]";
    }
    return $prefix;
  }

  private function __clone() {    
  }
  
  private function __construct() {    
    self::$_syslog_alias = EnviromentSingltone::getInstance()->getValue('syslog_alias');
    self::$_log_server  =  EnviromentSingltone::getInstance()->getValue('log_server');
    self::$_log_client  =  EnviromentSingltone::getInstance()->getValue('log_client');
    self::$_log_billing =  EnviromentSingltone::getInstance()->getValue('log_billing');
    openlog(self::$_syslog_alias, LOG_ODELAY, LOG_USER);    
  }
}