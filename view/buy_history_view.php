<!-- buy_history_view.php -->
<!-- 購入履歴画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'buy_history.css'; ?>">
  </head>
  <body>
    <div class="container">
    　<?php include_once VIEW_PATH . 'header_user_view.php'; ?>
      <div class="container_main">
        <div class="title">購入履歴</div>
        <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
        <?php foreach($datas as $value) { ?>
          <ul class="container_main_history"> 
            <li class="container_main_left">
              <img src="./image/<?php print $value['img']; ?>">
            </li>
            <li class="container_main_right">
              <div class="row1"><span class="space1">商品名</span>：<?php print $value['name']; ?></div>
              <div class="row2"><span class="space2">産地</span>：<?php print $value['area_name']; ?></div>
              <div class="row3">購入日時：<?php print $value['createdate']; ?></div>
              <div class="row4">
                <div class="number"><span class="space4_1">価格</span>：<?php print $value['price']; ?>円</div>
                <div class="price"><span class="space4_2"></span>個数：<?php print $value['amount']; ?>個</div>
              </div>
              <div class="row5"><span class="space5">計</span>：<?php print (int)$value['price'] * (int)$value['amount']; ?>円</div>
              <div class="row6">
                <?php if($value['stock'] === '0') { ?>
                  <div class="stock">在庫切れ</div>
                <?php } else { ?>
                  <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
                    <div class="stock"><input id="button_cart" type="submit", value="カートに追加">
                      <input type="hidden" name="data" value="update_cart">
                      <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                      <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                    </div>
                  </form>
                <?php } ?>
                <?php if($value['review_flag'] === 0) { ?>
                  <form method="post" enctype="multipart/form-data" action="./review_edit.php">
                    <span class="space6"></span>
                    <input class="review" type="submit", value="レビュー">
                    <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                    <input type="hidden" name="createdate" value="<?php print $value['createdate']; ?>">
                  </form>
                <?php } else { ?>
                  <div class="review"><span class="space6"></span>レビュー済</div>
                <?php } ?>
              </div>
            </li>
          </ul>
        <?php } ?>

      <div class="link"><a href="./items_list.php">商品一覧へ</a></div>
      </div>        
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>