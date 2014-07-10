<?php

class login_view extends ViewCore {
  
  public function modelChange($data = null) {
    if( ($data)&&
        (is_array($data))&&
        (isset($data['user_id'])) &&
        ($data['user_id']>0)      // TODO: MB need fix?
            ){
      return;
    }
    $this->_load_template();   
    $env = EnviromentSingltone::getInstance();
    $template_data = ['title'=>$env->getValue('title')];
    $this->_fill_template($template_data);
            
    return $this->_template;
  }  
  
}