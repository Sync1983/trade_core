<?php

/**
 * @name DBSingltone
 **/
class DBSingltone {
  /**
   * @var DBSingltone
   **/
  protected static $_instance;
  /**   
   * @var mysqli
   */
  protected $_db;
  
  /**
   * Получить instance
   * @return DBSingltone
   **/
  public static function getInstance() {
    if(self::$_instance==null)
      self::$_instance = new DBSingltone();
    return self::$_instance;
  }
  /**
   * Возвращает указатель на активный mysqli
   * @return mysqli
   */
  public function getDB() {
    return $this->_db;
  }
  
  public function chechAnswer($result,$query=""){
    if (!$result) {
      $message  = 'Неверный запрос: ' . $this->_db->error . "\n";
      $message .= 'Запрос целиком: ' . $query;
      die($message);
    }
  }

  private function __clone() {    
  }
  
  private function __construct() {    
    $this->_db = new mysqli();
    $env = EnviromentSingltone::getInstance()->getValue('db');
    $this->_db->connect($env['host'], $env['user'], $env['pass'], $env['db'], $env['port']);    
    $this->chechAnswer($this->_db->query("set names utf8;"),"set names utf8;");
  } 
  
}