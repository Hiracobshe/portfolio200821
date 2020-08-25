<?php

// DB操作
function get_items_area($dbh) {
    
  try {

    $sql = 'SELECT area.id,
                   area.area_name
            FROM   area';

    $stmt = db_prepare($dbh, $sql);
  
    return fetch_query($stmt);
      
  } catch (Exception $e) {
    set_error($e->getMessage());
  }
}  

?>