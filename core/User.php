<?php

class User extends DataItem {
  
  protected $user_name;
  protected $password;
  protected $role;
  
  protected $name;
  protected $secname;
  protected $parentname;
  
  protected $info;
  protected $users;
  
  protected $create_time;


  public function run($params) {
    $sid        = isset($_SESSION['id'])      ?$_SESSION['id']      :null;
    $cusername  = isset($_COOKIE['user_name'])?$_COOKIE['user_name'] :null;
    $cpass      = isset($_COOKIE['user_pass'])?$_COOKIE['user_pass'] :null;
    $suser_name = isset($params['user_name']) ?$params['user_name']  :null;
    $suser_pass = isset($params['user_pass']) ?$params['user_pass']  :null;
    $sremem     = isset($params['remember'])  ?$params['remember']  :null;
    
    $login = new LoginView($this);    
    
    if($sid) {
      $this->load_by_id($sid);        
    } elseif($cusername&&$cpass) {
      if($load_user = $this->load_by_name_pass($cusername, $cpass)) {        
        $this->load_by_id($load_user->getId());
      } else {        
        $login->show_login_page();      
        return false;
      }
    } elseif($suser_name&&$suser_pass) {
      if($load_user = $this->load_by_name_pass($suser_name, md5($suser_pass))) {        
        $this->load_by_id($load_user->getId());
        if($sremem=="on") {
          setcookie('user_name',$suser_name);
          setcookie('user_pass',md5($suser_pass));
        }
      } else {        
        $login->show_login_page();      
        return false;
      }
    } else {        
        $login->show_login_page();      
        return false;
    }
    
    return $this;    
  }

  public function __construct() {
    parent::__construct();
    $this->_table = $this->_mongo->users;
  }
  
  private function load_by_name_pass($user_name,$user_pass) {
    $load_user = $this->load_by_params(['user_name'=>$user_name,'password'=>$user_pass]);
    if(count($load_user)==1) {
      return $load_user;
    }
    return FALSE;
  }
  
}

