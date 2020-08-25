<?php

// 商品タイプ情報取得
function get_items_type($dbh) {
    
  try {

    $sql = 'SELECT type.id,
                   type.type_name
            FROM   type';

    // SQLの実行準備
    $stmt = db_prepare($dbh, $sql);
  
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }
}













?>