<?php

class menu_control extends ControllerCore {
  
  public function run($params = null) {    
    return $this->_model->change("create",$params);
  }
  
}
