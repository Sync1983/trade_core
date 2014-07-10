<?php

class menu_view extends ViewCore {
  
  public function modelChange($user = null) {        
    $this->_load_template();   
    $env = EnviromentSingltone::getInstance();
    $template_data = [
        'title'     =>  $env->getValue('title'),
        'user_name' =>  $user['user_firstname']. " " . $user['user_subname']
    ];
    $this->_fill_template($template_data);
            
    return $this->_template;
  }  
  
}