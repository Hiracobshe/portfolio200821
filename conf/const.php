<?php

  define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/gotouchi3/model/');
  define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/gotouchi3/view/');

  define('CSS_PATH', './html/assets/css/');
  define('ICON_PATH', './icon/');
  define('ITEM_PATH', './html/assets/images/item/');

  // データベースの接続情報
  define('DB_HOST', 'mysql');
  define('DB_NAME', 'codecamp33303');         // MySQLのDB名
  define('DB_USER', 'codecamp33303');       // MySQLのユーザ名
  define('DB_PASS', 'codecamp33303');       // MySQLのパスワード
  define('DB_CHARSET', 'SET NAMES utf8mb4');  // MySQLのcharset
  define('DSN', 'mysql:dbname='.DB_NAME.';host=localhost;charset=utf8');  // データベースのDSN情報
    
  define('IMG_DIR', './image/');
  define('HTML_CHARACTER_SET', 'UTF-8');      // HTML文字エンコーディング
    
  define('CSS_DIR', './CSS/');
    
  define('LOGIN_URL', 'login.php');  // ログインページ
  define('CART_DETAIL_URL', 'cart_detail.php');
  define('ITEMS_LIST_URL', 'items_list.php');
  define('MANAGE_ITEMS_URL', 'manage_items.php');
  define('REGISTER_URL', 'register.php');
  define('REVIEW_EDIT_URL', 'review_edit.php');
  define('BUY_HISTORY_URL', 'buy_history.php');
    
  define('REGEXP_POSITIVE_INTEGER', '<^[1-9][0-9]*$>'); // 正規表現 (1以上の整数値の入力)
  define('REGEXP_POSITIVE_INTEGER_STOCK', '<^[0-9]*$>'); // 正規表現 (0および0以上の整数値の入力)
  define('REGEXP_NAME', '/^[a-zA-Z0-9]+$/'); // 正規表現 (ユーザ名)
  define('REGEXP_PASSWORD', '/^[a-zA-Z0-9]+$/'); // 正規表現 (パスワード)
  define('REGEXP_MAIL', '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/'); // 正規表現(メールアドレス)
  define('REGEXP_NUMBER', '<^\d{7}$>'); // 正規表現 (郵便番号)
    
  define('MIN_LENGTH_NAME', 6); // ユーザ名の最低文字数
  define('MIN_LENGTH_PASSWORD', 6); // パスワードの最低文字数
  define('MAX_ITEMS_MANAGE_ITEMS', 4);  // 1ページあたりの最大商品掲載数 (商品管理)
  define('MAX_ITEMS_MANAGE_USER', 10);  // 1ページあたりの最大商品掲載数 (ユーザ履歴)
  define('MAX_ITEMS_MANAGE_BUY', 10);  // 1ページあたりの最大商品掲載数 (購入履歴)
  define('MAX_ITEMS_MANAGE_REVIEW', 10);  // 1ページあたりの最大商品掲載数 (レビュー履歴)
  define('MAX_ITEMS_ITEMS_LIST', 6);  // 1ページあたりの最大商品掲載数 (商品一覧)

?>