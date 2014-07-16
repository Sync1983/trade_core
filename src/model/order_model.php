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
    $data = $this->_orders->find(['archive'=>0])->sort(['time'=>1]);
    $this->_data = array('action'=>'show','items'=>iterator_to_array($data));
    return $this->_on_update();    
  }
  
  protected function _load_action($param) {    
    if(!isset($param['subaction'])) {
      $data = $this->_orders->find(['archive'=>0])->sort(['time'=>1]);
      $this->_data = array('action'=>'show','items'=>iterator_to_array($data));
      return $this->_succes_answer(['html'=>$this->_on_update()]);
    }
    switch ($param['subaction']) {
      case 'add_new':
        $item = [
            'archive'=>0,
            'ask'=>[],
            'price'=>[],
            'pay'=>[],
            'comming'=>[],
            'deliver'=>[],
            'time'=>  time(),
        ];
        $this->_orders->insert($item);
        break;
      case 'delete_order':
        if( (!isset($param['id']))||
            ($param['id'] == '')
           ) {
          Log::sendInfo("Try delete empty id");
          return false;
        }
        $id = new MongoId(strval($param['id']));
        $this->_orders->remove(['_id'=>$id]);
        break;

      default:
        break;
    }    
    $data = $this->_orders->find(['archive'=>0])->sort(['time'=>1]);
    $this->_data = array('action'=>'show','items'=>iterator_to_array($data));
    return $this->_succes_answer(['html'=>$this->_on_update()]);
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
