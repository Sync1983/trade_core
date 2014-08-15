<?php

class DataItem {
  protected $_mongo;
  protected $_table;
  
  protected $_id;
  
  public function getId() {    
    return $this->_id;
  }

  public function load_by_id($id) {
    if(!$this->_table) {
      Log::sendError("Undefined work table for class ".get_class($this));
      return false;
    }    
    $cursor = $this->_table->find(['_id'=>$id]);
    $fields = $cursor->limit(1)->getNext();       
    foreach ($fields as $key=>$value) {          
      $this->$key = $value;
    }    
  }
  
  public function load_by_params($params) {
    if(!$this->_table) {
      Log::sendError("Undefined work table for class ".get_class($this));
      return false;
    }
    $cursor = $this->_table->find($params);    
    $items = [];
    while($item = $cursor->getNext()) {      
      $add_item = new User();      
      $add_item->load_by_id($item['_id']);
      $items[] = $add_item;
    }
    if(count($items)==1) {
      return $items[0];
    }
    return $items;
  }

  public function __construct() {
    $this->_mongo = MongoSingltone::getInstance()->getDB();
  }
}

