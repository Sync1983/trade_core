<?php

/**
 * @name OutputSingltone
 **/
class OutputSingltone {
  /**
   * @var OutputSingltone
   **/
  protected static $_instance;  
  protected $_text;
  
  /**
   * Получить instance
   * @return OutputSingltone
   **/
  public static function getInstance() {
    if(self::$_instance==null) {
      self::$_instance = new OutputSingltone();
    }
    return self::$_instance;
  }
  /**
   * Возвращает указатель на активный mysqli
   * @return mysqli
   */
  public function getText() {
    return $this->_text;
  }
  
  public function setText($text){
    $this->_text = $text;    
  }
  
  public function setValue($name,$value){
    $this->_text = str_replace($name, $value, $this->_text);    
  }
  
  public function setValues(array $pair){
    foreach ($pair as $name => $value) {
      $this->_text = str_replace($name, $value, $this->_text);    
    }
  }
  
  public function Out(){
    echo $this->_text;
  }

  private function __clone() {    
  }
  
  private function __construct() {    
    $this->_text = "";    
  } 
  
}