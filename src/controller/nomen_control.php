<?php

class nomen_control extends ControllerCore {
  
  public function run($params = null) {
    if(!$params){
      return "";
    }
    
    if(isset($params['action'])){
      return $this->_model->change("ajax",$params);
    }
  }
  
}
