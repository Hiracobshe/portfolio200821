<?php

  // ファイル読込
  require_once './conf/const.php';
  require_once MODEL_PATH . 'function.php';
  require_once MODEL_PATH . 'user.php';

  session_start();
  
  // DB接続
  $db = db_connect();

  $name      = trim(get_post_data('name')     , " ");
  $password1 = trim(get_post_data('password1'), " ");
  $password2 = trim(get_post_data('password2'), " ");
  $mail      = trim(get_post_data('mail')     , " ");
  $number    = trim(get_post_data('number')   , " ");
  $address   = trim(get_post_data('address')  , " ");
  $sex       =      get_post_data('sex');
  $year      =      get_post_data('birth_year');
  $month     =      get_post_data('birth_month');
  $day       =      get_post_data('birth_day');
  

  // ユーザー名が6文字以上かどうかの確認
  if((mb_strlen($name)) < 6) {
    set_error('[エラー]ユーザー名は6文字以上で入力してください');

  } else {
    //正規表現
    if(!is_positive_name($name)) {
      set_error('[エラー]：不正なユーザー名です(半角英数字6文字以上で入力してください)');
    }

    $datas = get_username_register_ok($db, $name);

    //SQLの実行・ユーザー名重複の有無の確認
    if(count($datas) > 0) {
      set_error('[エラー]そのユーザー名はすでに使用されています');            
    }
  }
  
  // パスワードが6文字以上かどうかの確認
  if((mb_strlen($password1) < 6) || (mb_strlen($password2) < 6)) {
    set_error('[エラー]パスワードは6文字以上で入力してください');
  
  } else {
    if((!is_positive_password($password1)) || (!is_positive_password($password2))) {
      set_error('[エラー]：不正なパスワードです(半角英数字6文字以上で入力してください)');
    }
  }

  if($password1 !== $password2) {
    set_error('[エラー]：パスワードが一致しません');
  }

  if(mb_strlen($mail) === 0) {
    set_error('[エラー]：メールアドレスを入力してください');
    
  } else {
    if(!is_positive_address($mail)) {
      set_error('[エラー]：不正なメールアドレスです');
    }

    $data2 = select_mail_register_ok($db, $mail);
    
    if(count($data2) > 0) {
      set_error('[エラー]そのメールアドレスはすでに使用されています');            
    }
  }

  if(mb_strlen($number) === 0) {
    set_error('[エラー]：郵便番号を入力してください');

  } else {
    if(!is_positive_number($number)) {
      set_error('[エラー]：不正な郵便番号です(半角数字7桁で入力してください)');
    }
  }

  if(mb_strlen($address) === 0) {
    set_error('[エラー]：住所を入力してください');
  }
  
  if($sex === 'default') {
    set_error('[エラー]：性別を入力してください');
  }

  // 生年月日が適切かどうかの確認
  if(!(($year !== 'default') && ($month !== 'default') && ($day !== 'default')) &&
     !(($year === 'default') && ($month === 'default') && ($day === 'default'))) {
    set_error('[エラー]：生年月日を入力してください(入力しない場合は年月日すべてを「選択」にすること)');
  }

  if(!has_error()) {
    
    $hash = password_hash($password1, PASSWORD_DEFAULT);
    
    if((($year !== 'default') && ($month !== 'default') && ($day !== 'default'))) {
      $birthdate = $year . '-' . $month . '-' . $day;
    } else {
      $birthdate = null;
    }

    $date = date('Y-m-d H:i:s');    
    insert_user_register_ok($db, $name, $hash, $mail, $number, $address, (int)$sex, $birthdate, $date); 

    set_message('登録が完了しました．');

  } else {
    
    $db = null;
  
    redirect_to(REGISTER_URL);
    exit;
  }

  $db = null;

  // ファイル読込
  include_once VIEW_PATH . 'register_ok_view.php'

?>