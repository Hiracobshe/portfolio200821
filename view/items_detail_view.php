<!-- items_detail_view.php -->
<!-- 商品詳細画面 -->
<!-- include/gotouchi/view/items_detail_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品詳細画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'items_detail.css'; ?>">
  </head>
  <body>
    <div class="container">
        　<?php include_once VIEW_PATH . 'header_user_view.php'; ?>
      <div class="container_main">
        <div class="title">商品詳細説明</div>
        <div class="container_main_detail">
          <div class="container_main_left">
            <div class="center">
              <img src="./image/<?php print $data[0]['img']; ?>">
            </div>
            <div class="container_main_review">
            <?php if($data2[0]['review_point'] === '0') { ?>
              <div class="point">★-/5&nbsp;</div>
              <div class="review"></div>
            <?php } else { ?>
              <div class="point">★<?php print round($data2[0]['review_point'], 2) ?>/5&nbsp;<span class="l_space2"></span></div>
              <form method="post" enctype="multipart/form-data" action="./review_list.php"> 
                <div class="review"><input type="submit" value="レビュー"></div>
                <input type="hidden" name="item_id" value="<?php print $item_id; ?>">
              </form>
            <?php } ?>
            </div>
          </div>
          <div class="container_main_right">
            <div class="r_row1">名前：<?php print $data[0]['name']; ?></div>
            <div class="r_row2">産地：<?php print $data[0]['area_name']; ?></div>
            <div class="r_row3">価格：<?php print $data[0]['price']; ?>円</div>
            <div class="r_row4"><?php print $data[0]['comment']; ?></div>    
            <form method="post" enctype="multipart/form-data" action="./cart_detail.php"> 
            <?php if($data[0]['stock'] > 0) { ?>
              <div class="r_row5 center"><input type="submit" value="カートに追加"></div>
            <?php } else { ?>
              <div class="r_row5 center">在庫切れ</div>
            <?php } ?>
              <input type="hidden" name="data" value="update_cart">
              <input type="hidden" name="item_id" value="<?php print $item_id; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
            </form>
          </div>
        </div>  
        <div class="link"><a href="./items_list.php">戻る</a></div>
      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>