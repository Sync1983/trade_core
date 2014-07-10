<?php

class ViewCore {
  
  protected $_template;


  public function modelChange($data = null) {
    
  }  
  
  protected function _load_template($template_name = null) {
    if(!$template_name) {
      $view_name = get_class($this);
      $name = str_replace("_view", "", $view_name);
    } else {
      $name = escapeshellcmd($template_name);
    }
    $file_name = __DIR__."/../src/template/".$name."/".$name.".html";
    if(!file_exists($file_name)){
      Log::sendError("Template file $file_name not exist!");
      return false;
    }
    ob_start();
    include($file_name);
    $this->_template = ob_get_clean();
  }
  
  protected function _fill_template($data) {    
    foreach ($data as $key => $value) {         
      $this->_template = str_replace("%%".$key."%%", strval($value), $this->_template);      
    }
  }
  
}

