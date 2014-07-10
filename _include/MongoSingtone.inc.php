<?php

/**
 * @name DBSingltone
 **/
class MongoSingltone {
  /**
   * @var MongoSingltone
   **/
  protected static $_instance;
  /**   
   * @var MongoClient
   */
  protected $_db;
  
  /**
   * Получить instance
   * @return MongoSingltone
   **/
  public static function getInstance() {
    if(self::$_instance==null)
      self::$_instance = new MongoSingltone();
    return self::$_instance;
  }
  /**
   * Возвращает указатель на активный клиент
   * @return MongoDB
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
    $env = EnviromentSingltone::getInstance()->getValue('db');
    $m = new MongoClient("mongodb://".$env['host'].":".$env['port'], 
                          array(  "username" => $env['user'], 
                                  "password" => $env['pass'],
                                  "db"       => $env['db']));
    if(!$m) {
      Log::sendError("Can`t connect to Mongo");
      return FALSE;
    }
    
    $this->_db = $m->selectDB($env['db']);
  } 
  
}