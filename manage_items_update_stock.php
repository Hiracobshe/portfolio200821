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
    var_dump($page);
  }

  $token = get_post('csrf_token');



  if(is_valid_csrf_token($token)) {

    $csrf_token = get_csrf_token();
    
    $update_stock = trim(get_post_data('update_stock'), " ");
    $id           =      get_post_data('id');
    $date = date('Y-m-d H:i:s');

    if(mb_strlen($update_stock) === 0) {
      set_error('[エラー]：在庫を入力してください');
    } else if(preg_match('<^[0-9]*$>', $update_stock) === 0) {
      set_error('[エラー]：在庫を入力してください(0以上の整数)');
    }

    if(!has_error()) {
      update_stock_manage_items($dbh, $update_stock, $date, $id);
      set_message('[OK]：在庫を変更しました');
    }

  } else {
    set_error('[エラー]：不正なリクエストです．');
  }

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