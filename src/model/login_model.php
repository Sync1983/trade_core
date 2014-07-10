<?php

class login_model extends ModelCore {  
  
  /*
   * @var MongoDB
   */
  protected $_mongo;
  /*
   * @var MongoCollection
   */
  protected $_users;


  protected function _load_user($user_id) {  
    $this->_data = array(
        "user_id"       => 0,
        "user_role"     => "guest",        
        "user_name"     => "guest",
        "user_subname"  => "",
    );
    
    if((!$user_id)&&(!$this->_checkCookie())) {
      return false;
    }    
    
    $this->_set_data("user_id", $user_id);
    
    $result = $this->_users->find(["_id"=>$user_id])->limit(1);
    if(($result->count()==0)||!($user=$result->getNext())) {
      $_SESSION["user_id"] = null;
      $this->_error_answer("Пользователь не найден");
      return false;
    }
    
    foreach ($user as $key => $value) {   //Save user fields from db
      $this->_set_data($key, $value);
    }
    
    return $this;
  }
  
  protected function _checkCookie() {
    $cook = $_COOKIE;
    if((!isset($cook['user_name']))||
       (!isset($cook['user_pass']))) {
      return false;
    }    
    return false;
  }
  
  protected function _login($params) {
    $_SESSION['user_id'] = null;
    
    if(!$this->_checkSession()) {
      return FALSE;
    }     
    
    $name = isset($params['name'])?escapeshellcmd($params['name']):"guest";
    $pass = isset($params['pass'])?escapeshellcmd($params['pass']):"guest";
    $rmem = isset($params['rmem'])?(strval($params['rmem'])=="true"):false;
    Log::sendInfo("Login #".$_SESSION['login_count']." Name: $name Pass: $pass Remember: $rmem");
    
    try {
      $result = $this->_users->find(["user_name"=>$name,"password"=>  md5($pass)])->limit(1);
    } catch (Exception $ex) {
      Log::sendDebug("Mongo error: ".$ex->getMessage()." Trace: ".$ex->getTraceAsString());
      $this->_error_answer('Ошибка сервера');
      return false;
    }
    
    if($result->count()===0) {
      $this->_error_answer('Неверное имя пользователя или пароль');
      return false;
    }
    
    $actuve_user = $result->getNext();
    if(!$actuve_user) {
      $this->_error_answer('Ошибка авторизации');
      return false;
    }
    
    $_SESSION['user_id'] = $actuve_user['_id'];
    
    if($rmem) {
      setcookie("user_name", $name);
      setcookie("user_pass", md5($pass));
    }
    
    $this->_succes_answer();
  }
  
  private function _checkSession() {    
    if(!isset($_SESSION['login_count'])) {
      $_SESSION['login_count'] = 0;
    }
    
    if( (isset($_SESSION['last_login']))&&
        (time()-$_SESSION['last_login']>5*60) ){
      $_SESSION['login_count'] = 0;
    }
    
    if($_SESSION['login_count']++>50) {
      $this->_error_answer('Превышено число попыток. Следующий вход возможен через '. (5*60 - (time()-$_SESSION['last_login'])).' секунд.');
      return false;
    }
    
    $_SESSION['last_login'] = time();
  }


  public function __construct($view) {
    parent::__construct($view);    
    $this->_mongo = MongoSingltone::getInstance()->getDB();    
    $this->_users = $this->_mongo->users;
    if(!$this->_users) {
      Log::sendError("Cann`t access to users collection");
      return FALSE;
    }
  }
  
}
