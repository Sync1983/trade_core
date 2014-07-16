<?php

class order_control extends ControllerCore {
  
  public function run($params = null) {
    return $this->_model->change("load_action",$params);
  }
  
  public function load_user($user) {
    return $this->_model->change("load_user",$user);
  }

  public function out() {
    return $this->_model->change("on_update");
  }
  
}
