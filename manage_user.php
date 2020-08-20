<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'user.php';


  session_start();

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  if(!isset($_POST['page'])) {
    $page = 1;
  } else{
    $page = $_POST['page'];    
  }
  
  // ページ設定
  $count = get_count_manage_user($dbh);
  $from_page = ($page - 1) * MAX_ITEMS_MANAGE_USER;
  
  if($page === 1) {
    $prev_page = 0;
  } else {
    $prev_page = $page - 1;
  }
  
  if((int)$count[0][0] <= $from_page + MAX_ITEMS_MANAGE_USER) {
    $to_page = (int)$count[0][0];
    $num = $to_page - ($page - 1) * MAX_ITEMS_MANAGE_USER;
    $next_page = 0;
    
  } else {
    $to_page = $page * MAX_ITEMS_MANAGE_USER;
    $num = MAX_ITEMS_MANAGE_USER;
    $next_page = $page + 1;
  }


  $datas = get_user_manage_user($dbh, $from_page, $num);    

  $dbh = null;

  // ファイル読込
  include_once './view/manage_user_view.php';

?>