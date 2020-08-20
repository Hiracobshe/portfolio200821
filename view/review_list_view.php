<!-- review_list_view.php -->
<!-- レビュー一覧画面 -->
<!-- include/gotouchi/view/items_detail_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー一覧 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'review_list.css'; ?>">
  </head>
  <body>
    <div class="container">
        　<?php include_once VIEW_PATH . 'header_user_view.php'; ?>
      <div class="container_main">        
        <div class="title">レビュー一覧</div>
        <div class="container_main_top">
          <div class="container_main_left">
            <div class="col1 center">
              <img src="./image/<?php print $data1[0]['img']; ?>">        
            </div>
          </div>
          <div class="container_main_right">
            <div class="col2">
              <span class="row1">評価</span>：★<?php print $rating; ?>/5&nbsp;
            </div>
            <div class="col2">
              商品名：<?php print $data1[0]['name']; ?>
            </div>
            <div class="col2">
              <span class="row3">産地</span>：<?php print $data1[0]['area_name']; ?>
            </div>
            <div class="col2">
              <span class="row4">価格</span>：<?php print $data1[0]['price']; ?>円
            </div>
          </div>
        </div>
        <div class="container_main_bottom">
          <?php foreach($data3 as $value) { ?>
            <div class="review">
              <?php print $value['user_name']; ?>&nbsp;(★<?php print $value['point'] . '/5)&nbsp;&nbsp;&nbsp;' . $value['createdate'] . '<br>'; ?>
              <?php print $value['comment'] . '<br>'; ?>
            </div>
          <?php } ?>
          <div class="link">
            <form method="post" enctype="multipart/form-data" action="./items_list.php"> 
              <input type="submit" value="戻る">
            </form>
          </div>
        </div>
      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>