<?php

// オススメ商品情報取得
function get_recommend_items_list($dbh, $user_id) {

  // 商品情報の取得
  try {

    $sql = 'SELECT history.item_id
            FROM history
            WHERE history.user_id = ? 
            ORDER BY history.createdate DESC
            LIMIT 1';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);  
    $data5 = fetch_query($stmt);

    if(count($data5) > 0) {
  
      $item_id = $data5[0]['item_id'];

      $sql = 'SELECT items.type
              FROM   items
              WHERE  items.id = ?';

      $stmt = db_prepare($dbh, $sql);
      $stmt->bindValue(1, $item_id, PDO::PARAM_INT);  
      $data6 = fetch_query($stmt);        
        
      $sql = 'SELECT items.id,
                     items.name,
                     items.price,
                     items.img,
                     items.stock,
                     items.comment,
                     items.review_point,
                     type.type_name,
                     area.area_name
              FROM   items
              INNER JOIN type
              ON items.type = type.id
              INNER JOIN area
              ON items.area = area.id
              WHERE items.status = 1
              AND   items.type = ?
              ORDER BY items.createdate DESC
              LIMIT 3';

      $stmt = db_prepare($dbh, $sql);
      $stmt->bindValue(1, $data6[0]['type'], PDO::PARAM_INT);    
      return fetch_query($stmt);

    } else {

      $sql = 'SELECT items.id,
                     items.name,
                     items.price,
                     items.img,
                     items.stock,
                     items.comment,
                     items.review_point,
                     type.type_name,
                     area.area_name
              FROM   items
              INNER JOIN type
              ON items.type = type.id
              INNER JOIN area
              ON items.area = area.id
              WHERE items.status = 1
              ORDER BY items.createdate DESC
              LIMIT 3';

      $stmt = db_prepare($dbh, $sql);
      $datas = db_execute($stmt, 'select');

      return entity_assoc_array($datas);
    }
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
}

// 商品情報取得
function get_itemlist_items_list($dbh) {
  
  $check_type = get_post('check_type');
  $check_area = get_post('check_area');
  $keyword    = trim(get_post('keyword'), " ");
  $check_sort = get_post('check_sort');
    
  try {

    $sql = 'SELECT items.id,
                   items.name,
                   items.price,
                   items.img,
                   items.stock,
                   items.comment,
                   items.review_point,
                   items.createdate,
                   type.type_name,
                   area.area_name
            FROM   items
            INNER JOIN type
            ON items.type = type.id
            INNER JOIN area
            ON items.area = area.id
            WHERE items.status = 1';
            
    if($check_type !== 'default') {
      $sql .= ' AND type.id = ' . (int)$_POST['check_type'];
    }

    if($check_area !== 'default') {
      $sql .= ' AND area.id = ' . (int)$_POST['check_area'];
    }

    if(mb_strlen($keyword) > 0) {
      $sql .= ' AND items.name LIKE ?';
    }

    if($check_sort !== 'default') {

      if($check_sort === 'rating_high') {
        $sql .= ' ORDER BY items.review_point DESC, items.createdate DESC';
        
      } else if($check_sort === 'price_low') {
        $sql .= ' ORDER BY items.price ASC, items.createdate DESC';
  
      } else if($check_sort === 'price_high') {
        $sql .= ' ORDER BY items.price DESC, items.createdate DESC';

      } else {
        $sql .= ' ORDER BY items.createdate DESC';
      }
  
    } else {
        $sql .= ' ORDER BY items.createdate DESC';
    }
    
    $stmt = db_prepare($dbh, $sql);

    if(mb_strlen($keyword) > 0) {
      $stmt->bindValue(1, "%" . $keyword . "%", PDO::PARAM_STR);
    }
    
    return fetch_query($stmt);

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
}

// 商品詳細情報取得
function get_item_items_detail($dbh, $item_id) {
    
  try {

    $sql = 'SELECT items.name,
                   items.price,
                   items.img,
                   items.comment,
                   items.stock,
                   area.area_name
            FROM   items
            INNER JOIN area
            ON         items.area = area.id
            WHERE  items.id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);  
  
    return fetch_query($stmt);

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
}

// レビュー得点情報取得
function get_reviewpoint_items_detail($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT items.review_point
            FROM   items
            WHERE  items.id = ' . $item_id;

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);  
    
    return fetch_query($stmt);
    
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
} 

// レビュー対象の商品情報取得
function get_item_review_list($dbh, $item_id) {
    
  try {
      
    $sql = 'SELECT items.name,
                   items.price,
                   items.img,
                   area.area_name
            FROM   items
            INNER JOIN area
            ON         items.area = area.id
            WHERE  items.id = ?
            LIMIT 1';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $item_id, PDO::PARAM_INT); 
  
    return fetch_query($stmt);      
      
    } catch (Exception $e) {
        
      $err_msg[] = $e->getMessage();
    }     
  }

// レビュー対象商品の商品情報取得
function get_item_review_edit($dbh, $user_id, $item_id, $createdate) {

  try {

    $sql = 'SELECT history.user_id,
                   history.item_id,
                   history.createdate,
                   items.name,
                   items.img,
                   items.price,
                   area.area_name
            FROM   history
            INNER  JOIN items
            ON     history.item_id = items.id
            INNER  JOIN area
            ON    items.area = area.id
            WHERE  history.user_id = ? 
            AND    history.item_id = ? 
            AND    history.createdate = ?' ;

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $createdate, PDO::PARAM_STR);
    
    return fetch_query($stmt);

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }
}

// レビュー情報更新
function update_item_review_ok($dbh, $item_id, $review_point) {
    
  try {

    $sql = 'UPDATE items
            SET    review_point = ?
            WHERE  items.id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $review_point, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
    
    return execute_query($stmt);      

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 商品の在庫数更新
function update_items_buy_item($dbh, $stock, $item_id) {
    
  try {

    // SQL生成
    $sql = 'UPDATE items
            SET    stock = ? 
            WHERE  items.id = ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $stock, PDO::PARAM_INT);
    $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
  
    return execute_query($stmt);         
 
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  } 
}

// 商品リスト内商品件数取得
function get_count_manage_items($dbh) {
    
  try {
      
    $dbh = db_connect();
      
    $sql = 'SELECT COUNT(items.id)
            FROM   items
           ';

    $stmt = db_prepare($dbh, $sql);

    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 商品リスト内の商品情報を取得
function get_item_manage_items($dbh, $from_page, $num) {
    
  try {

    $sql = 'SELECT items.id,
                   items.name,
                   items.price,
                   items.img,
                   items.status,
                   items.stock,
                   items.type,
                   items.area,
                   items.comment,
                   items.review_point
            FROM   items
            limit  ?
            offset ?';

    $stmt = db_prepare($dbh, $sql);
    $stmt->bindValue(1, $num, PDO::PARAM_INT);
    $stmt->bindValue(2, $from_page, PDO::PARAM_INT);
     
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 商品管理リストに商品情報を追加
function insert_item_manage_items($dbh, $name, $price, $image, $status, $stock, $type, $area, $comment, $date) {
    
  try {

    $sql = 'INSERT INTO items (name, price, img, status, stock, type, area, comment, createdate, updatedate)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
  
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, (int)$price, PDO::PARAM_INT);
    $stmt->bindValue(3, $image, PDO::PARAM_STR);
    $stmt->bindValue(4, (int)$status, PDO::PARAM_STR);
    $stmt->bindValue(5, (int)$stock, PDO::PARAM_STR);
    $stmt->bindValue(6, (int)$type, PDO::PARAM_INT);
    $stmt->bindValue(7, (int)$area, PDO::PARAM_STR);
    $stmt->bindValue(8, $comment, PDO::PARAM_STR);      
    $stmt->bindValue(9, $date, PDO::PARAM_STR);
    $stmt->bindValue(10, $date, PDO::PARAM_STR);
    
    return execute_query($stmt);      
        
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 商品リスト内の商品データ削除
function delete_item_manage_items($dbh, $item_id) {
    
  try {
      
    $sql = 'DELETE  
            FROM    items
            WHERE   id = ?';

    $stmt->bindValue(1, $item_id, PDO::PARAM_INT);

    return execute_query($stmt);      

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}

// 商品コメント更新
function update_comment_manage_items($dbh, $update_comment, $date, $id) {
    
  try {
      
    $sql = 'UPDATE  items
            SET     comment = ?,
                    updatedate = ?
            WHERE   id = ?';

    $stmt = db_prepare($dbh, $sql);

    $stmt->bindValue(1, $update_comment, PDO::PARAM_STR);
    $stmt->bindValue(2, $date, PDO::PARAM_STR);
    $stmt->bindValue(3, $id, PDO::PARAM_INT);

    return execute_query($stmt);      

  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}


// 商品ステータス更新
function update_status_manage_items($dbh, $update_status, $date, $id) {

  try {
    
    $sql = 'UPDATE  items
            SET     status = ?,
                    updatedate = ?
            WHERE   id = ?';  

    $stmt = db_prepare($dbh, $sql);        

    if($update_status === 'private') {
      $stmt->bindValue(1, 0, PDO::PARAM_INT);
    } else {
      $stmt->bindValue(1, 1, PDO::PARAM_INT);
    }

    $stmt->bindValue(2, $date, PDO::PARAM_STR);
    $stmt->bindValue(3, $id, PDO::PARAM_INT);

    return execute_query($stmt);
  
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  } 
}

// 商品の在庫数更新
function update_stock_manage_items($dbh, $update_stock, $date, $id) {
    
  try {
      
    $sql = 'UPDATE  items
            SET     stock = ?,
                    updatedate = ?
            WHERE   id = ?';

    $stmt = db_prepare($dbh, $sql);

    $stmt->bindValue(1, $update_stock, PDO::PARAM_STR);
    $stmt->bindValue(2, $date, PDO::PARAM_STR);
    $stmt->bindValue(3, $id, PDO::PARAM_INT);

    return execute_query($stmt);      
     
  } catch (Exception $e) {
    $err_msg[] = $e->getMessage();
  }     
}


?>