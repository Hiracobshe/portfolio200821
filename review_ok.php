<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'review.php';
  require_once MODEL_PATH . 'history.php';  
  require_once MODEL_PATH . 'item.php';  

  // セッション開始
  session_start();

  $token = get_post('csrf_token');

  if(is_valid_csrf_token($token)) {

    $csrf_token = get_csrf_token();

    $dbh = db_connect();

    $user_id = get_session('user_id');
    $username = get_username($dbh, $user_id);

    $rating = get_post('rating');
    $postname = trim(get_post('postname'), " ");
    $comment = trim(get_post('comment'), " ");
    
    // エラーチェック
    if($rating === 'default') {
      set_error('[エラー]：評価を選択してください');
    }
    
    if(mb_strlen($postname) === 0) {
      set_error('[エラー]：投稿者名を入力してください');
    }
      
    if(!has_error()) {
  
      // トランザクション開始
      $dbh->beginTransaction();
  
      // レビュー情報の追加
      $item_id = get_post('item_id');
      $date    = date('Y-m-d H:i:s');

      insert_review_review_ok($dbh, $user_id, $postname, $item_id, $rating, $comment, $date);
      update_history_review_ok($dbh, $user_id, $item_id, $date);
        
      $datas = select_sum_review_ok($dbh, $item_id);
      $data2 = select_count_review_ok($dbh, $item_id);
      
      var_dump($datas[0]['SUM(point)'], $data2[0]['COUNT(point)']);
      
      $review_point = (float)$datas[0]['SUM(point)'] / (int)$data2[0]['COUNT(point)'];
      update_item_review_ok($dbh, $item_id, $review_point);

      if(!has_error()) {

        $dbh->commit();
        $dbh = null;

        set_message('[OK]：レビューを投稿致しました．');

      } else {

        $dbh->rollback();
        $dbh = null;

        redirect_to(BUY_HISTORY_URL);
        exit;
      }

    } else {

      $dbh = null;

      redirect_to(BUY_HISTORY_URL);
      exit;      
    }

  } else {

    set_error('[エラー]：不正なリクエストです．');

    redirect_to(ITEMS_LIST_URL);
    exit;
  }

  // ファイル読込
  include_once './view/review_ok_view.php';

?>