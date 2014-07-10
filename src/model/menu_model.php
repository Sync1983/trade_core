<?php

class menu_model extends ModelCore {  
  private $_user;
  
  protected function _create($user) {        
    $this->_user = $user->change("get_data");
    if($this->_user['user_id']!=$_SESSION['user_id']){
      Log::sendError("Loading menu from wrong user. Session: ".json_encode($_SESSION));
      return false;
    }
    $this->_data = $this->_user;
    return $this->_on_update();
  }
}
