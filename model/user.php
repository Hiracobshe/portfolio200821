<?php

  // ユーザ情報取得
  function get_user_session_login($dbh, $name) {
    
    try {
      
      $sql = 'SELECT users.id,
                     users.username,
                     users.password
              FROM   users
              WHERE  users.username = ?';
               
      $stmt = db_prepare($dbh, $sql);
      $stmt->bindValue(1, $name, PDO::PARAM_STR);
    
      return fetch_query($stmt);
      
    } catch (PDOException $e) {
      $err_msg[] = $e->getMessage();
    }     
  }

  // ユーザ名取得
  function get_username_register_ok($dbh, $name) {
    
    try {
      
      $sql = 'SELECT users.username
              FROM   users
              WHERE  users.username = ?';
    
      $stmt = db_prepare($dbh, $sql);
      $stmt->bindValue(1, $name, PDO::PARAM_STR);
      
      return fetch_query($stmt);
      
    } catch (Exception $e) {
      $err_msg[] = $e->getMessage();
    }     
  }

  // メールアドレス情報取得
  function select_mail_register_ok($dbh, $mail) {
    
    try {
      
    $sql = 'SELECT users.mail
            FROM   users
            WHERE  users.mail = ?';
    
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $mail, PDO::PARAM_STR);    
    
    return fetch_query($stmt);
      
    } catch (Exception $e) {
      $err_msg[] = $e->getMessage();
    }     
  }

// ユーザ件数取得
function get_count_manage_user($dbh) {
    
  try {
      
    $sql = 'SELECT COUNT(*)
            FROM   users
           ';

    $stmt = db_prepare($dbh, $sql);
  
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// ユーザ履歴取得
function get_user_manage_user($dbh, $from_page, $num) {
    
  try {
      
    $sql = 'SELECT users.id,
                   users.username,
                   users.password,
                   users.mail,
                   users.post,
                   users.address,
                   users.birthdate,
                   users.createdate
            FROM   users
            limit  ?
            offset ?';

    $stmt = db_prepare($dbh, $sql);
  
    $stmt->bindValue(1, (int)$num, PDO::PARAM_INT);
    $stmt->bindValue(2, (int)$from_page, PDO::PARAM_INT);

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}


?>