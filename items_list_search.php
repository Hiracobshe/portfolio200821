<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'type.php';
  require_once MODEL_PATH . 'area.php';

  // セッション開始
  session_start();

  $token = get_post('csrf_token');
  
  if(is_valid_csrf_token($token)) {

    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    $datas = get_recommend_items_list($dbh, $user_id);
    $data2 = get_items_type($dbh);
    $data3 = get_items_area($dbh);

    $data4 = get_itemlist_items_list($dbh);
  
    if(isset($data4)) {
      $count = get_count($data4);
        
      if($count === 0) {
        set_error('[エラー]：該当商品が見つかりませんでした．');
      }
      
    } else {
      $count = 0;
    }
    
    
      $dbh = null;
      
  } else {
    set_error('[エラー]：不正なリクエストです．');
    redirect_to(ITEMS_LIST_URL);
    exit;
  }
  
  // ファイル読込
  include_once './view/items_list_view.php';

?>