<?php

/*
 * @name Log
 */
class Log {
  /*
   * @var Log
   */
  protected static $_instance;  
  protected static $_syslog_alias;
  
  /*
   * @return Log
   */
  public static function getInstance() {
    if(self::$_instance==null) {
      self::$_instance = new Log();
    }
    return self::$_instance;
  }  
  
  public static function sendInfo($message) {
    $prefix = "[INF]".$message;
    syslog(LOG_USER, $prefix);
  }
  
  public static function sendDebug($message) {
    $prefix = "[DBG]".$message;
    syslog(LOG_USER, $prefix);
  }
  
  public static function sendError($message) {
    $prefix = "[ERR]".$message;
    syslog(LOG_USER, $prefix);
  }

  private function __clone() {    
  }
  
  private function __construct() {    
    self::$_syslog_alias = EnviromentSingltone::getInstance()->getValue('syslog_alias');    
    openlog(self::$_syslog_alias, LOG_ODELAY, LOG_USER);    
  }
}