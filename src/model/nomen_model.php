<?php

class nomen_model extends ModelCore {
  /*
   * @var MongoDB
   */
  protected $_mongo;
  /*
   * @var MongoCollection
   */
  protected $_nomen;
  private $_output;
  
  protected function _load() {    

  }
  
  protected function _show_sort($subaction) {
    $data = $this->_nomen->aggregate(
        [ '$group'=>[
            '_id'   =>   '$manufacture',
            'count' =>  ['$sum'=>1]  ],          
        ]);
    $rows = $data['result'];    
    
    $sorting = array();    
    foreach ($rows as $line) {
      if($line["_id"]=="") {
        $line["_id"]="empty";
      }
      $sorting[$line['_id']] = $line['count'];
    }
    
    $this->_data = [
        'mnf'=>$sorting,
        'action'=>$subaction,
    ];
      
    $this->_output = $this->_on_update();
    $this->_succes_answer(['html'=>  $this->_output]);
  }
  
  protected function _show_selected($name){
    $data = $this->_nomen->find(['manufacture'=>$name])->sort(['articul'=>1]);    
    $html = "";
    foreach ($data as $row) {      
      $html.= "<tr id='".$row["_id"]."'>".
              "<td>".$row['articul']."</td>".
              "<td>".$row['manufacture']."</td>".
              "<td>".$row['name']."</td>".
              "<td>".$row['cars']."</td>".
              "<td>изменить/удалить</td>"."</tr>";      
    }
    $this->_data = [
        'html'=>$html,
        'action'=>'show_name',
    ];
      
    $this->_output = $this->_on_update();
    $this->_succes_answer(['html'=>  $this->_output]);
  }

  protected function _ajax($param) {        
    $action = isset($param['action'])?strval($param['action']):"main";
    $action = escapeshellcmd($action);
    $subaction = isset($param['subaction'])?strval($param['subaction']):"none";
    $subaction = escapeshellcmd($subaction);
    
    if($action!=="nomen") {
      $this->_error_answer("Undefined action");
      Log::sendError("Loading undefined action $action");
      return "";
    }
    
    if(in_array($subaction, ['none','sort_by_name','sort_by_cnt'])) {
      $this->_show_sort($subaction);
    }
    
    if(in_array($subaction, ['select_name'])) {
      $this->_show_selected($param['name']);
    }
  }
  
  public function __construct($view) {
    parent::__construct($view);    
    $this->_mongo = MongoSingltone::getInstance()->getDB();    
    $this->_nomen = $this->_mongo->nomen;
    if(!$this->_nomen) {
      Log::sendError("Cann`t access to nomen collection");
      return FALSE;
    }
  }
  
}
