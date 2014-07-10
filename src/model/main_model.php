<?php

class main_model extends ModelCore {
  private $_session;  
  private $_user;
  
  protected function _load() {    
    $this->_session = $_SESSION;    
    
    $fabric = FabricSingltone::getInstance();
    $login = $fabric->createModule('login');
    if(isset($this->_session['user_id'])) {
      $this->_user_id = $this->_session['user_id'];    
    }
    
    if(!($this->_user = $login->load_user($this->_user_id))) {
      $login->out();
      return false;
    }
    echo $this->_on_update();
  }
}
