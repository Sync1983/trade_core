 <?php
include './common.inc.php';

$user   = new User();
$post   = $_POST;
$get    = $_GET;
$user_obj = $user->run(array_merge($get,$post));
if(!$user_obj) {
  return;
}

$view = new MainView($user_obj);
$view->show();
 

/*ob_start();
include(__DIR__.'/template/head.html');
include(__DIR__.'/template/body.html');
include(__DIR__.'/template/footer.html');
$main_template = ob_get_clean();  

$db_inst = DBSingltone::getInstance();
$db = $db_inst->getDB();

$query_menu = "SELECT * from menu where parent_id = 0 order by id desc";
$db_inst->chechAnswer($result = $db->query($query_menu));
  
$main_menu = "";  
  while ($row = $result->fetch_assoc()) {
     $main_menu .= "<li class=\"menu-item\" id=\"menu".$row['id']."\"><a href=\"?page=".$row['id'].
                   "\">".$row['name']."</a></li>";
  }

$result->free();

$page = isset($_GET['page'])?$_GET['page']:(isset($_POST['page'])?$_POST['page']:1);

if(!$page) {
  $page = 1;
}
$page = $page*1;

$query_page= "SELECT page_text from pages where page_id = ".intval($page)." limit 0,1";
$db_inst->chechAnswer($page_result = $db->query($query_page));
  
$row = $page_result->fetch_assoc();
$page_text = $row['page_text'];
$page_result->free();


$Out = OutputSingltone::getInstance();
$Out->setText($main_template);
$Out->setValue("%%menu%%",$main_menu);
$Out->setValue("%%page%%",$page_text);

$Out->Out();
*/