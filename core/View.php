<?php

class View {
  
  protected $_template;
   
  protected function _load_template($template_name = null) {
    $view_name = get_class($this);    
    $name = $view_name;
    if($template_name){
      $name = escapeshellcmd($template_name);
    }    
    $file_name = __DIR__."/../template/".$view_name."/".$name.".html";
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

