<?php

class MainView extends View {
  /** @var User ActiveUser **/
  protected $_user;
  protected $_data;

  public function show() {    
    $this->makeMainMenu();
    $this->_load_template();    
    $env = EnviromentSingltone::getInstance();
    $this->_data['title'] = $env->getValue('title');    
    $this->_fill_template($this->_data);    
    echo $this->_template;
    return;
  }
  
  protected function makeMainMenu() {
    $this->_load_template("Menu");
    $data = [];    
    $this->_fill_template($data);
    $this->_data['menu'] = $this->_template;
  }
  
  public function __construct(User $user) {
    $this->_user = $user;
  }
  
}

