<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'history.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $csrf_token = get_csrf_token();

  $datas = get_history_buy_history($dbh, $user_id);

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'buy_history_view.php';
?>