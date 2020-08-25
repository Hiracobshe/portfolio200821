<?php

// SQL実行準備完了
function db_prepare($dbh, $sql) {
  return $dbh->prepare($sql);
}

// SQL実行
function db_execute($stmt, $mode) {
  
  if(($mode === 'insert') || ($mode === 'update') || ($mode === 'delete')) {
    $stmt->execute(); 
  }
  
  if($mode === 'select') {
    $stmt->execute(); 
    // レコードの取得
    $rows = $stmt->fetchAll();
    return $rows;
  }
}

// SQL実行 (データ取得)
function fetch_query($statement) {
  try{
    $statement->execute();
    $rows = $statement->fetchAll();
    return $rows;
  }catch(PDOException $e){
    set_error('データ取得に失敗しました．' . $e);
  }
  return false;
}

// SQL実行 (データ追加・更新・削除)
function execute_query($statement){
  try{
    $statement->execute();
  }catch(PDOException $e){
    set_error('更新に失敗しました。' . $e);
  }
}

// DBハンドルを取得
function db_connect() {
 
  try {
    // データベースに接続
    $dbh = new PDO(DSN, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => DB_CHARSET));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  } catch (PDOException $e) {
    throw $e;
  }
  
  return $dbh;
}

// データ件数を取得
function get_count($count) {
  return count($count);
}

// ユーザ名の取得
function get_username($dbh, $user_id) {

  try {
      
    $sql = 'SELECT users.username
            FROM   users
            WHERE  users.id = ' . $user_id;

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
    
    //SQLの実行
    $row = fetch_query($stmt);

    return $row[0]['username'];

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
}

// トークンの生成
function get_csrf_token(){

  $token = get_random_string(30);
  set_session('csrf_token', $token);

  return $token;
}

// トークンのチェック
function is_valid_csrf_token($token){

  if($token === '') {
    return false;
  }

  return $token === get_session('csrf_token');
}

// ハッシュ値の生成
function get_random_string($length){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

// リダイレクト
function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

// GET変数を取得
function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}

// GET変数をセット
function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

// FILE変数をセット
function get_file($name){
  if(isset($_FILES[$name]) === true){
    return $_FILES[$name];
  };
  return array();
}

// クッキーを取得
function get_cookie($name){
  if(isset($_COOKIE[$name]) === true){
    return $_COOKIE[$name];
  };
  return '';
}

// クッキーをセット
function set_cookie($name, $value){
  $_COOKIE[$name] = $value;
}

// SESSION変数を取得
function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

// SESSION変数をセット
function set_session($name, $value){
  $_SESSION[$name] = $value;
}

// SERVER変数を取得
function get_server($name){
  if(isset($_SERVER[$name]) === true){
    return $_SERVER[$name];
  };
  return '';
}

// エラーメッセージをセット
function set_error($error){
  $_SESSION['__errors'][] = $error;
}

// エラーメッセージを取得
function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}

// エラー情報の有無を確認する
function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

// メッセージを取得
function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

// メッセージをセット
function set_message($message){
  $_SESSION['__messages'][] = $message;
}

// ログイン確認
function is_logined(){
  return get_session('user_id') !== '';
}

// 正規表現の確認
function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}

function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}

function is_positive_stock($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER_STOCK);
}

function is_positive_name($string){
  return is_valid_format($string, REGEXP_NAME);
}

function is_positive_password($string){
  return is_valid_format($string, REGEXP_PASSWORD);
}

function is_positive_address($string){
  return is_valid_format($string, REGEXP_MAIL);
}

function is_positive_number($string){
  return is_valid_format($string, REGEXP_NUMBER);
}

function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}

// 特殊文字をHTMLエンティティに変換する
function hsc($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>
