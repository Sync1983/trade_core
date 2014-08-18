 <?php
include './common.inc.php';

$user   = new User();
$post   = $_POST;
$get    = $_GET;
$user_obj = $user->run(array_merge($get,$post));
if(!$user_obj) {
  return;
}

if(isset($user_obj["AJAX"])||(class_exists($user_obj["AJAX"]))){
  $class = new $user_obj();
  if(!is_subclass_of($class, "ClassAJAX")) {
    echo json_encode(array('error'=>'undefined ajax class'));
    return;
  } else {
    $class->run($user_objs);
    return;
  }  
}

$view = new MainView($user_obj);
$view->show();