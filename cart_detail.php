<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'cart.php';

  session_start();

  $csrf_token = get_csrf_token();
  
    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    $datas = select_cart_cart_detail($dbh, $user_id);

    if(count($datas) === 0) {
      set_error('[エラー]：カート内に商品はありません．');
    }
    
  $dbh = null;

  // ファイル読込
  include_once './view/cart_detail_view.php';

?>