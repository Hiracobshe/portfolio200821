<?php

// SQL実行準備完了
function db_prepare($dbh, $sql) {
  return $dbh->prepare($sql);
}


// SQL実行 (あとで削除すること)
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


function fetch_query($statement) {
  try{
    $statement->execute();
    $rows = $statement->fetchAll();
    return $rows;
  }catch(PDOException $e){
    set_error('データ取得に失敗しました。');
  }
  return false;
}


function execute_query($statement){
  try{
    return $statement->execute();
  }catch(PDOException $e){
    set_error('更新に失敗しました。' . $e);
  }
  return false;
}



// DBハンドルを取得
// @return obj $dbh DBハンドル
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


// 特殊文字をHTMLエンティティに変換する
function entity_str($str) {
  return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}


// 特殊文字をHTMLエンティティに変換する(2次元配列の値) (あとで削除)
function entity_assoc_array($assoc_array) {
 
  foreach ($assoc_array as $key => $value) {
    foreach ($value as $keys => $values) {
      
      // 特殊文字をHTMLエンティティに変換
      $assoc_array[$key][$keys] = entity_str($values);
    }
  }
 
  return $assoc_array;
} 


// GETデータから任意データを取得する (あとで削除する)
function get_get_data($key) {

  $str = '';

  if(isset($_GET[$key])) {
    $str = $_GET[$key];
  }

  return $str;
}


// POSTデータから任意データを取得する (あとで削除する)
function get_post_data($key) {

  $str = '';

  if(isset($_POST[$key])) {
    $str = $_POST[$key];
  }

  return $str;
}


// セッション変数の取得
function get_session_data($key){

  if(isset($_SESSION[$key]) === true){
    return $_SESSION[$key];
  };
  
  return '';
}


// セッション変数をセットする
function set_session_data($key, $value){
  $_SESSION[$key] = $value;
}


// データ件数を取得
function get_count($count) {
  return count($count);
}


// ユーザIDの取得
function get_user_id() {
    
  if(get_session_data('user_id') !== '') {
    return $_SESSION['user_id'];
  
  } else {
    //非ログインの場合，ログインページへリダイレクト
    //header('Location: login.php');
  }
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
    $row = db_execute($stmt, 'select');

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



// DB操作
function get_count_items_list($dbh) {

  try {
      
    $sql = 'SELECT COUNT(*)
            FROM   items
           ';

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
  
    //SQLの実行
    $datas = db_execute($stmt, 'select');      

    return entity_assoc_array($datas);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }  
  
}

// DB操作
function select_item_cart_detail($dbh, $item_id) {
    
  try {
      
    // SQL生成
    $sql = 'SELECT items.name,
                   items.stock
            FROM   items
            WHERE  items.id = ' . $item_id;

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
  
    //SQLの実行
    $datas = db_execute($stmt, 'select');      

    return entity_assoc_array($datas);
    
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}


  function update_buyamount_cart_detail($dbh, $buy, $item_id) {
    
    try {
      
        // SQL生成
        $sql = 'UPDATE carts
                SET    amount = ' . $buy . ' 
                WHERE  carts.item_id = ' . $item_id;

        // SQLの実行準備
        $stmt = db_prepare($dbh, $sql);
  
        //SQLの実行
        db_execute($stmt, 'update');      

    } catch (Exception $e) {
        
      $err_msg[] = $e->getMessage();
    }     
  }















  function insert_user_register_ok($dbh, $name, $hash, $mail, $number, $address, $sex, $birthdate, $date) {
    
    try {
      
      // SQL生成
      $sql = 'INSERT INTO users (username, password, mail, post, address, sex, birthdate, createdate, updatedate)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';

      // SQLの実行準備
      $stmt = db_prepare($dbh, $sql);
  
      $stmt->bindValue(1, $name, PDO::PARAM_STR);
      $stmt->bindValue(2, $hash, PDO::PARAM_STR);
      $stmt->bindValue(3, $mail, PDO::PARAM_STR);
      $stmt->bindValue(4, $number, PDO::PARAM_STR);
      $stmt->bindValue(5, $address, PDO::PARAM_STR);
      $stmt->bindValue(6, $sex, PDO::PARAM_INT);
      $stmt->bindValue(7, $birthdate, PDO::PARAM_STR);
      $stmt->bindValue(8, $date, PDO::PARAM_STR);
      $stmt->bindValue(9, $date, PDO::PARAM_STR);

      //SQLの実行
      db_execute($stmt, 'insert');      
     
    } catch (Exception $e) {
        
      $err_msg[] = $e->getMessage();
    }     
  }








function dd($var){
  var_dump($var);
  exit();
}

// リダイレクト
function redirect_to($url){
  header('Location: ' . $url);
  exit;
}

function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}

function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function get_file($name){
  if(isset($_FILES[$name]) === true){
    return $_FILES[$name];
  };
  return array();
}

function get_cookie($name){
  if(isset($_COOKIE[$name]) === true){
    return $_COOKIE[$name];
  };
  return '';
}

function set_cookie($name, $value){
  $_COOKIE[$name] = $value;
}

function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

function set_session($name, $value){
  $_SESSION[$name] = $value;
}

function get_server($name){
  if(isset($_SERVER[$name]) === true){
    return $_SERVER[$name];
  };
  return '';
}

function set_error($error){
  $_SESSION['__errors'][] = $error;
}

function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}

function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

function set_message($message){
  $_SESSION['__messages'][] = $message;
}

// ログイン確認
function is_logined(){
  return get_session('user_id') !== '';
}


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

function hsc($str){

  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}








?>
