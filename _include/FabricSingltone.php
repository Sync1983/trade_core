<?php

/*
 * @name FabricSingltone
 */
class FabricSingltone{
  private $_path = "undefined";
  /*
   * @var FabricSingltone
   */
  protected static $_instance;  
    
  /*
   * @return FabricSingltone
   */
  public static function getInstance() {
    if(self::$_instance==null) {
      self::$_instance = new FabricSingltone();
    }
    return self::$_instance;
  }  
  
  public function createModule($name) {
    $name = strip_tags(escapeshellcmd($name));    //Clear input data    
    if(!$this->_checkMVC($name)) {
      Log::sendError("Creating module ".$name." is fail");
      return false;
    }
    return $this->_addMVC($name);
  }
  
  private function _checkMVC($name) { 
    $view_path  = $this->_path."view/".$name."_view.php";
    $model_path = $this->_path."model/".$name."_model.php";
    $ctrl_path  = $this->_path."controller/".$name."_control.php";
    if(!file_exists($view_path)) {
      Log::sendDebug("View path $view_path for action $name not found!");
      return false;
    } elseif(!file_exists($model_path)) {
      Log::sendDebug("Model path $model_path for action $name not found!");
      return false;
    } elseif(!file_exists($ctrl_path)) {
      Log::sendDebug("Controller path $ctrl_path for action $name not found!");
      return false;
    }
    return true;
  }
  
  private function _addMVC($name) {    
    //Create MVC objects and return controller
    include_once($this->_path."view/".$name."_view.php");    
    include_once($this->_path."model/".$name."_model.php");
    include_once($this->_path."controller/".$name."_control.php");
    
    try {
      $model_name = $name."_model";
      $model_view = $name."_view";
      $model_ctrl = $name."_control";
      $view   = new $model_view();
      $model  = new $model_name($view);      
      $ctrl   = new $model_ctrl($model);
    } catch (Exception $ex) {
      Log::sendError("Creating MVC ".$name." error: ". $ex->getMessage()." Trace: ".$ex->getTraceAsString());
      return false;
    }
            
    return $ctrl;
  }

  private function __clone() {    
  }
  
  private function __construct() {        
    $this->_path = __DIR__."/../src/";
  }
}