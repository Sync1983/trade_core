<?php

class Trade_Core {  
  
  public function run($params) {
    session_start();
    $view   = 'main';
    $fabric = FabricSingltone::getInstance();
    
    if(isset($params['view'])) {
      $view = strip_tags(escapeshellcmd($params['view']));    //Clear input data
    }
    
    $ctrl = $fabric->createModule($view);
    
    if(!$ctrl) {
      Log::sendError("Can`t create module ".$view);
      echo "System error";
      return false;
    }
    $ctrl->run($params);
  }
  
}

