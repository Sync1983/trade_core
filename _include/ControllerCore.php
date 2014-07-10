<?php

Class ControllerCore {
  /*
   * @var ModelCore
   */
  protected $_model = null;
  
  public function __construct($model) {
    $this->_model = null;   
    $parents = class_parents($model);
    if(!in_array('ModelCore', $parents)) {
      Log::sendError("Model ".$model." have not parent ModelCore");              
      return false;
    }
    $this->_model = $model;
  } 
  
  public function run($params = null) {
    Log::sendError("Called default method from ControllerCore");
    return false;
  }
  
}

