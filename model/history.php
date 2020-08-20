<?php

// 購入履歴情報取得
function get_history_buy_history($dbh, $user_id) {

try {

  $sql = 'SELECT history.user_id,
                 history.item_id,
                 history.amount,
                 history.createdate,
                 history.review_flag,
                 items.name,
                 items.price,
                 items.img,
                 items.stock,
                 area.area_name
          FROM   history
          INNER  JOIN items
          ON     history.item_id = items.id
          INNER  JOIN area
          ON     items.area = area.id
          WHERE  history.user_id = ?';
  
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);  

    return fetch_query($stmt);

  } catch (Exception $e) {
    set_error($e->getMessage());
  }
}

// 購入履歴追加
function update_history_review_ok($dbh, $user_id, $item_id, $date) {
    
  try {
      
    $sql = 'UPDATE history
            SET    createdate = ?,
                   review_flag = ?
            WHERE  history.user_id = ? 
            AND    history.item_id = ?';

    $stmt = db_prepare($dbh, $sql);

    $stmt->bindValue(1, $date, PDO::PARAM_STR);
    $stmt->bindValue(2, 1, PDO::PARAM_INT);
    $stmt->bindValue(3, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(4, $item_id, PDO::PARAM_INT);
    
    return execute_query($stmt);      
     
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// 購入履歴追加
function insert_history_buy_item($dbh, $user_id, $item_id, $amount, $price, $date, $data2) {
    
  try {

    $sql = 'INSERT INTO history (user_id, item_id, amount, price, createdate, review_flag)
              VALUES(?, ?, ?, ?, ?, ?)';

    $stmt = db_prepare($dbh, $sql);
  
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $amount, PDO::PARAM_INT);
    $stmt->bindValue(4, $price, PDO::PARAM_INT);
    $stmt->bindValue(5, $date, PDO::PARAM_STR);

    if(count($data2) > 0) {
        $stmt->bindValue(6, 1, PDO::PARAM_INT);  
    } else {
      $stmt->bindValue(6, 0, PDO::PARAM_INT);          
    }    

    return execute_query($stmt);
 
  } catch (Exception $e) {
    set_error($e->getMessage());
  } 
}

// 購入履歴件数取得
function get_count_manage_buy($dbh) {
    
  try {

    $sql = 'SELECT COUNT(*)
            FROM   history
           ';

    $stmt = db_prepare($dbh, $sql);
      
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 購入履歴取得
function get_history_manage_buy($dbh, $from_page, $num) {
    
  try {
      
    $sql = 'SELECT history.user_id,
                   history.item_id,
                   history.amount,
                   history.price,
                   history.review_flag
            FROM   history
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