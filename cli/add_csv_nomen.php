<?php

include './../common.inc.php';

$name = "./price1.csv";

$mongo = MongoSingltone::getInstance()->getDB();
$nomen = $mongo->nomen;

$f = fopen($name, "r");
if(!$f) {
  echo "File $name not found!\r\n";
  return;
}

$line  = 0;
while(!feof($f)){
  $str = fgets($f);  
  $data = explode(";", $str);  
  $ins = array(
      "manufacture" => $data[0],
      "articul"     => $data[1],
      "name"        => $data[2],
      "cars"        => $data[3]
      );  
  $nomen->insert($ins);
  echo "Line $line \r\n";
  $line++;
  
}

fclose($f);

/*

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
      

*/