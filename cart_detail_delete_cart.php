<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'cart.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $token = get_post('csrf_token');

  if(is_valid_csrf_token($token)) {
  
    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    $item_id = get_post('item_id');

    delete_cart_cart_detail($dbh, $user_id, $item_id);
    set_message('[OK]：商品を削除しました．');

    $datas = select_cart_cart_detail($dbh, $user_id);

    if(count($datas) === 0) {
      set_error('[エラー]：カート内に商品はありません．');
    }
    
    $dbh = null;

  } else {
    set_error('[エラー]：不正なリクエストです．');
    redirect_to(ITEMS_LIST_URL);
    exit;
  }

  // ファイル読込
  include_once VIEW_PATH . 'cart_detail_view.php';

?>