<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'cart.php';

  session_start();

  $token = get_post('csrf_token');

  if(is_valid_csrf_token($token)) {
  
    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);
    
    $item_id = get_post('item_id');
    $buy     = get_post('buy');

    $datas = select_cart_cart_detail($dbh, $user_id);

    $date = date('Y-m-d H:i:s');
    $datas = get_cart_cart_detail($dbh, $user_id, $item_id);

    if(count($datas) > 0) {
  
      if($buy === '') {
  
        if($buy < $datas[0]['stock']) {
          // 購入数を1プラス
          $amount = (int)$datas[0]['amount'] + 1;
  
        } else {
          // ただし在庫数と同等の場合，購入数を1プラスしない
          $amount = (int)$datas[0]['amount'];
        }
        
      } else {
        $amount = $buy;
      }

      update_cart_cart_detail($dbh, $amount, $user_id, $item_id);
      set_message('[OK]：商品を更新しました．');

    } else {
      insert_cart_cart_detail($dbh, $user_id, $item_id, $date);
      set_message('[OK]：商品を追加しました．');
    }

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
  include_once './view/cart_detail_view.php';
?>