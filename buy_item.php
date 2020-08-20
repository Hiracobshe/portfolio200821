<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'cart.php';
  require_once MODEL_PATH . 'review.php';
  require_once MODEL_PATH . 'history.php';  
  require_once MODEL_PATH . 'item.php';  
  
  session_start();

  $token = get_post('csrf_token');

  if(is_valid_csrf_token($token)) {
  
    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    // トランザクション開始
    $dbh->beginTransaction();

    // DB操作
    $datas = select_cart_buy_item($dbh, $user_id);

    foreach($datas as $value) {

      $date = date('Y-m-d H:i:s');
      $item_id = $value['item_id'];
      $amount = $value['amount'];
      $price = $value['price'] * $amount;
      $stock = $value['stock'] - $amount;

      $data2 = select_review_buy_item($dbh, $user_id, $item_id);
      insert_history_buy_item($dbh, $user_id, $item_id, $amount, $price, $date, $data2);
      update_items_buy_item($dbh, $stock, $item_id);
      delete_cart_buy_item($dbh, $user_id);
    }    
    
    if(!has_error()) {
      // コミット
      $dbh->commit();
      $dbh = null;
      
      set_message('購入手続きが完了致しました．');
        
    } else {
      // ロールバック
      $dbh->rollback();
      $dbh = null;
      
      redirect_to(CART_DETAIL_URL);
      exit;
    }
       
  } else {
    set_error('[エラー]：不正なリクエストです．');
    
    redirect_to(ITEMS_LIST_URL);
    exit;
  }

  // 商品管理画面テンプレートファイル読み込み
  include_once './view/buy_item_view.php';

?>