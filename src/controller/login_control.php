<?php

class login_control extends ControllerCore {
  
  public function run($params = null) {
    if(!$params) {
      return;
    }
    if(isset($params['view'])&&($params['view']=='login')) {
      $this->_model->change('login',$params);
    }
    
  }

  public function load_user($user_id){
    return $this->_model->change("load_user",$user_id);
  }

  public function out() {
    echo $this->_model->change("on_update");
  }
  
}
