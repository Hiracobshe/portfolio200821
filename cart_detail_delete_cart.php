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
  include_once './view/cart_detail_view.php';






/*



    // カート情報の更新
    if (($_SERVER['REQUEST_METHOD'] === 'POST') && ($_POST['data'] === 'update_cart')) {
      
      $date = date('Y-m-d H:i:s');
  
      // DB操作      
      $datas = get_cart_cart_detail($dbh, $user_id, $item_id);

      // 商品が既にカートに入っていた場合
      if(count($datas) > 0) {
          
        if($datas[0]['amount'] < $datas[0]['stock']) {
          // 購入数を1プラス
          $amount = (int)$datas[0]['amount'] + 1;
        } else {
          // ただし在庫数と同等の場合，購入数を1プラスしない
          $amount = (int)$datas[0]['amount'];
        }

        // DB操作
        update_cart_cart_detail($dbh, $amount, $user_id, $item_id);

      // 重複なし
      } else {
        // DB操作
        insert_cart_cart_detail($dbh, $user_id, $item_id, $date);
      }
    }

    // カート情報の削除
    if (($_SERVER['REQUEST_METHOD'] === 'POST') && ($_POST['data'] === 'delete_cart')) {
      // DB操作
      delete_cart_cart_detail($dbh, $user_id, $item_id);
    }

    // 購入数の更新
    if (($_SERVER['REQUEST_METHOD'] === 'POST') && ($_POST['data'] === 'update_buy')) {

      $buy     = (int)trim(get_post_data('buy'), " ");

      // エラーチェック
      if(mb_strlen($buy) === 0) {
        $err_msg[] = '[エラー]：購入数を入力してください';
      } else if(preg_match('<^[1-9][0-9]*$>', $buy) === 0) {
        $err_msg[] = '[エラー]：購入数を入力してください(0より大きい整数)';
      }

      if(count($err_msg) === 0){
        $datas = select_item_cart_detail($dbh, $item_id);
        
        if($buy > $datas[0]['stock']) {
          $err_msg[] = '[エラー]：申し訳ございません．' . $datas[0]['name'] . 'の購入可能数は最大' . $datas[0]['stock'] . '個です．';
        }
      }

      // エラーなし
      if(count($err_msg) === 0){
        // DB操作
        update_cart_cart_detail($dbh, $buy, $user_id, $item_id);
      }
    }






*/




?>