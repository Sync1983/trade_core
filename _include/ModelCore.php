<?php

class ModelCore {
 /*
  * @var ViewCore
  */ 
 protected $_view = null;
 protected $_data = array(); 
  
 public function __construct($view) {
   $this->_view = null;   
   $parents = class_parents($view);
   if(!in_array('ViewCore', $parents)) {
    Log::sendError("View ".$view." have not parent ViewCore");              
    return false;
   }
   $this->_view = $view;
 } 
 
 public function change($action,$data=null) {
   $function = "_".escapeshellcmd($action);
   try {
     return $this->$function($data);
   } catch (Exception $exc) {
     Log::sendError("Call function $function error: ".$exc->getMessage()." Trace: ".$exc->getTraceAsString());     
   }
   return false;
 }
 
 protected function _error_answer($message) {
   echo json_encode(['error'=>$message]);
 }
 
 protected function _succes_answer() {
   echo json_encode(['succes'=>1]);
 }
 
 protected function _data_answer($data) {
   echo json_encode(['data'=>$data]);
 }
 
 protected function _set_data($field,$data) {
   $this->_data[$field]=$data;
 }
 
 protected function _get_data($field) {
   return $this->_data[$field];
 }

 protected function _on_update() {
  if(!$this->_view){
    Log::sendError("Updatin null viewer!".get_class($this));
    return false;
  }
  return $this->_view->modelChange($this->_data);
 }
  
}

