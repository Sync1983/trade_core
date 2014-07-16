<?php

class order_view extends ViewCore {
  protected $_item_template;

  public function modelChange($data = null) {
    $this->_load_template();
    
    if((!$data)||(!is_array($data))) {
      return $this->_template;
    }
    
    if(!isset($data['action'])||($data['action']=='show')) {
      return $this->_show_empty($data);
    }
      
    $this->_load_template();
    
    //$this->_fill_template($template_data);
            
    return $this->_template;
  }  
  
  private function _show_empty($data) {    
    if((!$data)||(!is_array($data))) {
      return $this->_template;
    }    
    if(isset($data['items'])) {
      $data = $data['items'];
    } else {
      $data = [];
    }
    $this->_load_template("item");    
    $html = "";
    $tmp  = "";    
    foreach ($data as $row) {
      $tmp = $this->_template;
      $tmp = str_replace("%%id%%", $row["_id"], $tmp);
      $tmp = str_replace("%%time%%", date("d.m.Y H:i:s",$row["time"]), $tmp);
      $html.=$tmp;      
    }
    
    $this->_load_template();
    $this->_fill_template(array('orders'=>$html));
    return $this->_template;
  }
  
}