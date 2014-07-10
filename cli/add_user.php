<?php

include './../common.inc.php';

$name = $argv[1];
$pass = $argv[2];

echo "Add user $name with pass $pass as md5 ".md5($pass)."\r\n";
if((!$name)||(!$pass)) {
  echo "Parameters must username,password\r\n";
  exit(1);
}

$mongo = MongoSingltone::getInstance()->getDB();
$users = $mongo->users;
$result = $users->find(["user_name"=>$name,"password"=>  md5($pass)]);
if($result->count()>0) {
  echo "User already exist!\r\n";
  exit(1);  
}

if(!$result = $users->insert(["user_name"=>$name,"password"=>  md5($pass)])) {
  echo "Add user error!\r\n";
  exit(1);  
}

if($users->save()) {
  echo "Save user error!\r\n";
  exit(1);  
}
      

