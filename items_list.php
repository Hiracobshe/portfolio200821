<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'type.php';
  require_once MODEL_PATH . 'area.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $csrf_token = get_csrf_token();

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);
  
  $datas = get_recommend_items_list($dbh, $user_id);
  $data2 = get_items_type($dbh);
  $data3 = get_items_area($dbh);

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'items_list_view.php';

?>