<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';

  // セッション開始
  session_start();
  
  // Cookie情報を取得
  if(isset($_COOKIE['cookie_check'])) {
    $cookie_check = 'checked';
  } else {
    $cookie_check = '';
  }
  
  if(isset($_COOKIE['cookie_name'])) {
    $cookie_name = $_COOKIE['cookie_name'];    
  } else {
    $cookie_name = '';    
  }

  $cookie_check = htmlspecialchars($cookie_check, ENT_QUOTES, 'UTF-8');
  $cookie_name  = htmlspecialchars($cookie_name , ENT_QUOTES, 'UTF-8');

  // ファイル読込
  include_once VIEW_PATH . 'login_view.php';

?>