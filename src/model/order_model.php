<?php

class order_model extends ModelCore {    
  /*
   * @var MongoDB
   */
  protected $_mongo;
  /*
   * @var MongoCollection
   */
  protected $_orders;  

  protected function _load_user($user) {  
    $this->_user = $user->change("get_data");
    
    if($this->_user['user_id']!=$_SESSION['user_id']){
      Log::sendError("Loading orders from wrong user. Session: ".json_encode($_SESSION));
      return false;
    }
    
    return $this->_on_update();    
  }

  public function __construct($view) {
    parent::__construct($view);    
    $this->_mongo = MongoSingltone::getInstance()->getDB();    
    $this->_orders = $this->_mongo->order;
    if(!$this->_orders) {
      Log::sendError("Cann`t access to order collection");
      return FALSE;
    }
  }
  
}
