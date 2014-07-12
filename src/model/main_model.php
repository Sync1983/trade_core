<?php

class main_model extends ModelCore {
  private $_session;  
  private $_user;
  private $_output;
  
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
    
    $this->_output = $this->_on_update();
    
    $menu = $fabric->createModule('menu');
    $order= $fabric->createModule('order');
    $menu_text = $menu->run($this->_user);
    $order_text = $order->run($this->_user);
    
    $this->_output = str_replace("%%menu%%", $menu_text, $this->_output);
    $this->_output = str_replace("%%main%%", $order_text, $this->_output);
    echo $this->_output;
  }
  
  protected function _ajax($param) {
    $action = isset($param['action'])?strval($param['action']):"order";
    $action = escapeshellcmd($action);
    
  }
}
