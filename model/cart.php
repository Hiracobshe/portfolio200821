<?php

// カート内の商品情報取得
function select_cart_cart_detail($dbh, $user_id) {
    
  try {
      
    $sql = 'SELECT carts.id,
                   carts.user_id,
                   carts.item_id,
                   carts.amount,
                   items.id,
                   items.name,
                   items.price,
                   items.img,
                   items.stock,
                   area.area_name
            FROM   carts
            INNER JOIN items
            ON carts.item_id = items.id
            INNER JOIN area
            ON items.area = area.id
            WHERE carts.user_id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);  

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報取得
function get_cart_cart_detail($dbh, $user_id, $item_id) {
    
  try {
      
    $sql = 'SELECT carts.id,
                   carts.amount,
                   items.stock
            FROM   carts
            INNER JOIN items
            ON carts.item_id = items.id
            WHERE user_id = ? 
            AND   item_id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);  
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);  

    return fetch_query($stmt);

  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報更新
function update_cart_cart_detail($dbh, $amount, $user_id, $item_id) {
    
  try {
      
    $sql = 'UPDATE carts
            SET    amount = ? 
            WHERE user_id = ? 
            AND   item_id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $amount, PDO::PARAM_INT);  
    $stmt->bindValue(2, $user_id, PDO::PARAM_INT);  
    $stmt->bindValue(3, $item_id, PDO::PARAM_INT);  

    return execute_query($stmt);
     
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報追加
function insert_cart_cart_detail($dbh, $user_id, $item_id, $date) {
    
  try {

    // SQL生成
    $sql = 'INSERT INTO carts (user_id, item_id, amount, createdate, updatedate)
            VALUES(?, ?, ?, ?, ?)';

    $stmt = db_prepare($dbh, $sql);
  
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
    $stmt->bindValue(3, 1       , PDO::PARAM_INT);
    $stmt->bindValue(4, $date, PDO::PARAM_STR);
    $stmt->bindValue(5, $date, PDO::PARAM_STR);
  
    return execute_query($stmt);      
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報削除
function delete_cart_cart_detail($dbh, $user_id, $item_id) {
    
  try {

    $sql = 'DELETE
            FROM carts
            WHERE user_id = ? 
            AND   item_id = ?';

    $stmt = db_prepare($dbh, $sql);
    
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);  

    return execute_query($stmt);      
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報取得
function select_cart_buy_item($dbh, $user_id) {
    
  try {
        
    // SQL生成
    $sql = 'SELECT carts.user_id,
                   carts.item_id,
                   carts.amount,
                   items.price,
                   items.stock,
                   items.name,
                   items.img,
                   area.area_name
            FROM   carts
            INNER JOIN items
            ON carts.item_id = items.id
            INNER JOIN area
            ON         items.area = area.id
            WHERE  carts.user_id = ?';

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);

    return fetch_query($stmt);
 
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// カート内商品情報削除
function delete_cart_buy_item($dbh, $user_id) {
    
  try {
      
    // SQL生成
    $sql = 'DELETE 
            FROM  carts
            WHERE  carts.user_id = ?';

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
  
    return execute_query($stmt);      

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  } 
}

?>