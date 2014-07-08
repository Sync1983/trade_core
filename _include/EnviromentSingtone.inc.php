<?php

/*
 * @name EnviromentSingltone 
 */
class EnviromentSingltone {
  /*
   * @var EnviromentSingltone
   */
  protected static $_instance;
  protected static $_id = 55;  
  
  /*
   * @return EnviromentSingltone
   */
  public static function getInstance() {
    if(self::$_instance==null)
      self::$_instance = new EnviromentSingltone();
    return self::$_instance;
  }
  
  public function hasValue($name){
    if(!isset($_ENV[self::$_id][$name]))
      return false;
    return true;
  }

  public function getValue($name) {
   if(!isset($_ENV[self::$_id][$name]))
     throw new Exception ("Record with name $name not found!");
   return $_ENV[self::$_id][$name];
  }
  
  public function setValue($name,$value) {
    if(!isset($_ENV[self::$_id][$name]))
      $_ENV[self::$_id][$name] = $value;
  }

  
  private function __clone() {    
  }
  
  private function __construct() {    
    if(!isset($_ENV[self::$_id]))
      $_ENV[self::$_id] = array();
  }
}