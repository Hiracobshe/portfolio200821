<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'review.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $item_id = get_post('item_id');
    
  $data1 = get_item_review_list($dbh, $item_id);
  $data2 = get_reviewpoint_review_list($dbh, $item_id);
  $data3 = get_review_review_list($dbh, $item_id);

  if($data2[0]['review_point'] === '0') {
    $rating = '-';
  } else {
    $rating = round($data2[0]['review_point'], 2);
  }

  $csrf_token = get_csrf_token();

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'review_list_view.php';

?>