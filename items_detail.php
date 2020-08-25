<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $csrf_token = get_csrf_token();
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $item_id = get_get('item_id');
  
    $data = get_item_items_detail($dbh, $item_id);
    $data2 = get_reviewpoint_items_detail($dbh, $item_id);
  
  } else {
    redirect_to(ITEMS_LIST_URL);  
  }

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'items_detail_view.php';

?>