<?php

class nomen_view extends ViewCore {
  
  private $_html_temp;
  
  private function _show_none($data) {
    $this->_load_template();  
    $html = "";    
    $mnf  = $data['mnf'];
    $start = 0;
    $start = 0;
    $step = 15;    
    $cnt = 0;
    $html_line = "";
    foreach ($mnf as $name=>$count) {
      $html_line .= 
        '<a href="#" class="list-group-item" onclick="window.nomen.select(\''.$name.'\');"><span class="badge">'.$count.'</span>'.$name.'</a>';
      if($cnt++>$step) {
        $tmp = $this->_html_temp;
        $html_line = str_replace("%%items%%", $html_line, $tmp);
        $html_line = str_replace("%%start%%", $start+1, $html_line);
        $html_line = str_replace("%%stop%%",  $start+$cnt, $html_line);
        $html.=$html_line;
        $start += $cnt;
        $cnt = 0;
        $html_line = "";
      }
    }
    
    $template_data = ['rows'=>$html];
    $this->_fill_template($template_data);            
    return $this->_template;
  }
  
  private function _show_name($html) {
    $this->_load_template("table");
    $this->_fill_template(array('rows'=>$html));
    return $this->_template;
  }
  
  public function modelChange($data = null) {
    if($data['action']=='none') {
      return $this->_show_none($data);
    }elseif($data['action']=='sort_by_name') {      
      ksort($data['mnf']);
      return $this->_show_none($data);
    }elseif($data['action']=='sort_by_cnt') {      
      arsort($data['mnf']);
      return $this->_show_none($data);
    }elseif($data['action']=='show_name') {            
      return $this->_show_name($data['html']);
    }
    
  }  
  
  public function __construct() {
    $this->_html_temp = ' <div class="mfc">
                            <div class="panel-heading">Производители %%start%%-%%stop%%</div>
                            <div class="panel-body">
                            %%items%%          
                            </div>
                          </div>';
  }
  
}