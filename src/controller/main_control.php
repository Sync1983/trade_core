<?php

class main_control extends ControllerCore {
  
  public function run($params = null) {
    if(!$params){
      $this->_model->change("load");
    }
    
    if(isset($params['action'])){
      
    }
  }
  
}
