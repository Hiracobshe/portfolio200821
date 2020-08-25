<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';

  session_start();

  if(!is_logined()) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $csrf_token = get_csrf_token();

  $item_id = get_post('item_id');
  $createdate = get_post('createdate');

  $data = get_item_review_edit($dbh, $user_id, $item_id, $createdate);

  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'review_edit_view.php';

?>