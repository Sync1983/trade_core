<?php

class order_control extends ControllerCore {
  
  public function run($params = null) {  
    if((!is_array($params))||(!in_array('subaction', $params))) {
      return $this->_model->change("load_user",$params);
    } else {
      return $this->_model->change("load_action",$params);
    }
  }

  public function out() {
    return $this->_model->change("on_update");
  }
  
}
