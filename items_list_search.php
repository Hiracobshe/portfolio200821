<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'type.php';
  require_once MODEL_PATH . 'area.php';

  session_start();
  
  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }  

  $token = get_post('csrf_token');
  
  if(is_valid_csrf_token($token)) {

    $csrf_token = get_csrf_token();
    
    $check_type = get_post('check_type');
    $check_area = get_post('check_area');
    $keyword    = get_post('keyword');
    $check_sort = get_post('check_sort');

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    $datas = get_recommend_items_list($dbh, $user_id);
    $data2 = get_items_type($dbh);
    $data3 = get_items_area($dbh);

    // ページ設定
    if(!isset($_POST['page'])) {
      $page = 1;
    } else{
      $page = $_POST['page'];    
    }

    $from_page = ($page - 1) * MAX_ITEMS_ITEMS_LIST;
  
    if($page === 1) {
      $prev_page = 0;
    } else {
      $prev_page = $page - 1;
    }
  
    $data5 = get_itemlist_items_list($dbh);
    $count = count($data5);

    if($count <= $from_page + MAX_ITEMS_ITEMS_LIST) {
      $to_page = $count;
      $num = $to_page - ($page - 1) * MAX_ITEMS_ITEMS_LIST;
      $next_page = 0;
    
    } else {
      $to_page = $page * MAX_ITEMS_ITEMS_LIST;
      $num = MAX_ITEMS_ITEMS_LIST;
      $next_page = $page + 1;
    }

    $data4 = get_itemlist_items_list($dbh, $from_page, $num);

    if(count($data4) === 0) {
      set_error('[エラー]：該当商品が見つかりませんでした．');
    }
      
    $dbh = null;
      
  } else {
    set_error('[エラー]：不正なリクエストです．');
    redirect_to(ITEMS_LIST_URL);
    exit;
  }
  
  // ファイル読込
  include_once VIEW_PATH . 'items_list_view.php';

?>