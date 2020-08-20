<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'user.php';
  
  // ログイン中でない場合
  if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to(LOGIN_URL);
    exit;
  }
  
  session_start();

  // DB接続
  $dbh = db_connect();
  
  $name     = get_post('name');
  $password = get_post('password');

  if(isset($_POST['cookie_check'])) {
    $check = get_post('cookie_check');
  } else {
    $check = '';
  }

  $now = time();

  // Cookieへ保存
  // 「ユーザ名入力の省略」ONの場合
  // coocieへ保存する
  if($check === 'checked') {
    setcookie('cookie_check', $check, $now + 60 * 60 * 24 * 365);
    setcookie('cookie_name' , $name,  $now + 60 * 60 * 24 * 365);

  // 「ユーザ名入力の省略」OFFの場合
  // cookieを削除する
  } else {
    setcookie('cookie_check', '', $now - 3600);
    setcookie('cookie_name' , '',  $now - 3600);    
  }

  $row = get_user_session_login($dbh, $name);
  $dbh = null;

  // 登録データのパスワードと入力パスワードが一致しているかの確認
  if((isset($row[0]['username'])) && (password_verify($password, $row[0]['password']) === TRUE)) {
    set_session('user_id', $row[0]['id']);
    get_csrf_token();

    redirect_to(ITEMS_LIST_URL);
    exit;

  // 管理者がログインする場合
  } else if (($name === 'admin') && ($password === 'admin')) {
    set_session('user_id', 'admin');
    get_csrf_token();

    redirect_to(MANAGE_ITEMS_URL);
    exit;

  } else {
    set_error('[エラー]：ユーザ名またはパスワードに誤りがあります．');

    redirect_to(LOGIN_URL);
    exit;
  }

?>