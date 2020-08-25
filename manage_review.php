<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'review.php';

  session_start();

  if((!is_logined()) || (get_session('user_id') !== 'admin')) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  if(!isset($_POST['page'])) {
    $page = 1;
  } else{
    $page = $_POST['page'];    
  }

  // DB操作
  $count = get_count_manage_review($dbh);

  // ページ設定
  $from_page = ($page - 1) * MAX_ITEMS_MANAGE_REVIEW;
  
  if($page === 1) {
    $prev_page = 0;
  } else {
    $prev_page = $page - 1;
  }
  
  if((int)$count[0][0] <= $from_page + MAX_ITEMS_MANAGE_REVIEW) {
    $to_page = (int)$count[0][0];
    $num = $to_page - ($page - 1) * MAX_ITEMS_MANAGE_REVIEW;
    $next_page = 0;
    
  } else {
    $to_page = $page * MAX_ITEMS_MANAGE_REVIEW;
    $num = MAX_ITEMS_MANAGE_REVIEW;
    $next_page = $page + 1;
  }

  $datas = get_review_manage_review($dbh, $from_page, $num);

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'manage_review_view.php';

?>