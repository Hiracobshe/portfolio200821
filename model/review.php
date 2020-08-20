<?php

// レビュー対象商品のレビュー得点取得
function get_reviewpoint_review_list($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT items.review_point
            FROM   items
            WHERE  items.id = ?
            LIMIT 1';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);
    
    return fetch_query($stmt);      
  
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// レビュー対象商品のレビュー一覧取得
function get_review_review_list($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT review.user_name,
                   review.point,
                   review.comment,
                   review.createdate
            FROM   review
            WHERE  review.item_id = ?
            AND    review.comment != \'\'';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);  

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// レビュー情報追加
function insert_review_review_ok($dbh, $user_id, $postname, $item_id, $rating, $comment, $date) {
    
  try {
      
    $sql = 'INSERT INTO review (user_id, user_name, item_id, point, comment, createdate)
            VALUE(?, ?, ?, ?, ?, ?)';

    $stmt = db_prepare($dbh, $sql);

    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $postname, PDO::PARAM_STR);
    $stmt->bindValue(3, $item_id, PDO::PARAM_INT);
    $stmt->bindValue(4, $rating, PDO::PARAM_INT);
    $stmt->bindValue(5, $comment, PDO::PARAM_STR);
    $stmt->bindValue(6, $date, PDO::PARAM_STR);

    return execute_query($stmt);      
     
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// レビュー得点取得
function select_sum_review_ok($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT SUM(point)
            FROM   review
            WHERE  review.item_id = ?';
            
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// レビュー件数取得
function select_count_review_ok($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT COUNT(point)
            FROM   review
            WHERE  review.item_id = ?';
            
    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }     
}

// 購入商品レビュー情報取得
function select_review_buy_item($dbh, $user_id, $item_id) {
    
  try {

    // SQL生成
    $sql = 'SELECT review.id
            FROM   review
            WHERE  review.user_id = ?
            AND    review.item_id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);

    return fetch_query($stmt);      

  } catch (Exception $e) {
    set_error($e->getMessage());
  } 
}

// レビュー履歴件数取得
function get_count_manage_review($dbh) {
    
  try {
      
    $sql = 'SELECT COUNT(*)
            FROM   review
           ';

    $stmt = db_prepare($dbh, $sql);
  
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// レビュー履歴取得
function get_review_manage_review($dbh, $from_page, $num) {
    
  try {

    $sql = 'SELECT review.user_id,
                   review.user_name,
                   review.item_id,
                   review.point,
                   review.comment
            FROM   review
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