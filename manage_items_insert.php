<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'item.php';
  require_once MODEL_PATH . 'type.php';
  require_once MODEL_PATH . 'area.php';

  session_start();

  if((!is_logined()) || (get_session('user_id') !== 'admin')) {
    redirect_to(SESSION_LOGOUT_URL);
  }

  $dbh = db_connect();

  $user_id = get_session('user_id');
  $username = get_username($dbh, $user_id);

  $types = get_items_type($dbh);
  $areas = get_items_area($dbh);

  if(!isset($_POST['page'])) {
    $page = 1;
  } else{
    $page = $_POST['page'];    
  }

  $token = get_post('csrf_token');

  if(is_valid_csrf_token($token)) {

    $csrf_token = get_csrf_token();
    
    $date = date('Y-m-d H:i:s');
    $name    = trim(get_post('insert_name'), " ");
    $type    =      get_post('insert_type');
    $area    =      get_post('insert_area');
    $price   = trim(get_post('insert_price'), " ");
    $stock   = trim(get_post('insert_stock'), " ");
    $status  =      get_post('insert_status');
    $comment = trim(get_post('insert_comment'), " ");  

    if(mb_strlen($name) === 0) {
      set_error('[エラー]：商品名を入力してください');
    } else if((mb_strlen($name)) > MAX_LENGTH_ITEMNAME) {
      set_error('[エラー]：商品名は' . MAX_LENGTH_ITEMNAME . '文字以内で入力してください');
    }

    if($type === 'default') {
      set_error('[エラー]：種類を選択してください');
    }

    if(!is_positive_integer($price)) {
      set_error('[エラー]：価格を入力してください(0より大きい整数)');
    }
          
    if(!is_positive_integer($stock)) {
      set_error('[エラー]：在庫を入力してください(0より大きい整数)');
    }
    
    if($area === 'default') {
      set_error('[エラー]：産地を選択してください');
    }
  
    if($status === 'default') {
      set_error('[エラー]：公開フラグを選択してください');
    }
  
    // HTTP POST でファイルがアップロードされたかどうかチェック
    if (is_uploaded_file($_FILES['insert_image']['tmp_name'])) {
      
      // 画像の拡張子を取得
      $extension = pathinfo($_FILES['insert_image']['name'], PATHINFO_EXTENSION);
      
      // 指定の拡張子であるかどうかチェック
      if ($extension === 'jpg' || $extension === 'jpeg') {
            
        // 保存する新しいファイル名の生成（ユニークな値を設定する）
        $image = sha1(uniqid(mt_rand(), true)). '.' . $extension;
        
        // 同名ファイルが存在するかどうかチェック
        if (!is_file(ITEM_PATH . $image)) {

          // アップロードされたファイルを指定ディレクトリに移動して保存
          if (!move_uploaded_file($_FILES['insert_image']['tmp_name'], ITEM_PATH . $image)) {
            set_error('ファイルアップロードに失敗しました');
          }
          
        } else {
          set_error('[エラー]：ファイルアップロードに失敗しました。再度お試しください。');
        }
        
      } else {
        set_error('[エラー]：ファイル形式が異なります。画像ファイルはJPEGまたはPNGのみ利用可能です。');
      }

    } else {
      set_error('[エラー]：ファイルを選択してください');
    }
  
    if(!has_error()) {
      insert_item_manage_items($dbh, $name, $price, $image, $status, $stock, $type, $area, $comment, $date);
      set_message('[OK]：商品を追加しました');     
    }
  
  } else {
    set_error('[エラー]：不正なリクエストです．');
    redirect_to(MANAGE_ITEMS_URL);
    exit;
  }
  
  // ページ設定
  $count = get_count_manage_items($dbh);
  $from_page = ($page - 1) * MAX_ITEMS_MANAGE_ITEMS;
  
  if($page === 1) {
    $prev_page = 0;
  } else {
    $prev_page = $page - 1;
  }
  
  if((int)$count[0][0] <= $from_page + MAX_ITEMS_MANAGE_ITEMS) {
    $to_page = (int)$count[0][0];
    $num = $to_page - ($page - 1) * MAX_ITEMS_MANAGE_ITEMS;
    $next_page = 0;
    
  } else {
    $to_page = $page * MAX_ITEMS_MANAGE_ITEMS;
    $num = MAX_ITEMS_MANAGE_ITEMS;
    $next_page = $page + 1;
  }

  $datas = get_item_manage_items($dbh, $from_page, $num);  
    
  $dbh = null;

  // ファイル読込
  include_once VIEW_PATH . 'manage_items_view.php';

?>