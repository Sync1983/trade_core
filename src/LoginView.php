<?php

class LoginView extends View {  

  public function show_login_page() {
    $this->_load_template();    
    $env = EnviromentSingltone::getInstance();
    $data = [
        'title' =>$env->getValue('title'),
        'menu'  =>'',
    ];
    
    $this->_fill_template($data);
    
    echo $this->_template;
  }
  
}


