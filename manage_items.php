<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'type.php';
  require_once MODEL_PATH . 'area.php';

  session_start();

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $types = get_items_type($dbh);
  $areas = get_items_area($dbh);

  if(!isset($_POST['page'])) {
    $page = 1;
  } else{
    $page = $_POST['page'];    
  }

  $csrf_token = get_csrf_token();

  // ページ設定
  $count = get_count_manage_items($dbh);
  $from_page = ($page - 1) * MAX_ITEMS_MANAGE_ITEMS;
  
  if($page === 1) {
    $prev_page = 0;
  } else {
    $prev_page = $page - 1;
  }
  
  if((int)$count[0][0] <= $from_page + MAX_ITEMS_MANAGE_ITEMS) {
    $to_page = (int)$count[0][0];
    $num = $to_page - ($page - 1) * MAX_ITEMS_MANAGE_ITEMS;
    $next_page = 0;
    
  } else {
    $to_page = $page * MAX_ITEMS_MANAGE_ITEMS;
    $num = MAX_ITEMS_MANAGE_ITEMS;
    $next_page = $page + 1;
  }

  $datas = get_item_manage_items($dbh, $from_page, $num);  
    
  $dbh = null;

  // ファイル読込
  include_once './view/manage_items_view.php';

?>