<?php

class main_view extends ViewCore {
  
  public function modelChange($data = null) {    
    $this->_load_template();   
    $env = EnviromentSingltone::getInstance();
    $template_data = ['title'=>$env->getValue('title')];
    $this->_fill_template($template_data);
            
    return $this->_template;
  }  
  
}