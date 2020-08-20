<!-- cart_detail_view.php -->
<!-- 購入内容確認画面 -->
<!-- include/gotouchi/view/cart_detail_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入内容確認 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'cart_detail.css'; ?>">
  </head>
  <body>
    <div class="container">
    <?php include_once './view/header_user_view.php'; ?>

      <div class="container_main">
        <div class="title">購入内容確認</div>
<?php include_once VIEW_PATH . 'templates/messages.php'; ?>
          <div class="container_main_top">
          <?php $sum   =    0; ?>
          <?php foreach($datas as $value) { ?>
            <ul>
              <li class="container_main_left">
                <div class="col1" rowspan="4"><img src="./image/<?php print $value['img']; ?>"></div>
              </li>
              <li class="container_main_right">
                <div class="row1">商品名：<?php print $value['name']; ?></div>
                <div class="row2"><span class="space2">産地</span>：<?php print $value['area_name']; ?></div>
                <div class="row3"><span class="space3">価格</span>：<?php print $value['price']; ?>円</div>
                <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
                <div class="row4">
                  <div class="number">
                    <span class="space4">個数</span>：<input type="text"  name="buy"  value="<?php print $value['amount'];?>"    size="4">個
                  </div>
                  <div class="change">
                    <input type="submit" value="変更">
                    <input type="hidden" name="data" value="update_cart">
                    <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                    <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                  </div>
                </div>
                </form>
                <form method="post" enctype="multipart/form-data" action="./cart_detail_delete_cart.php">
                <div class="row5">
                  <div class="total">
                    <?php $price = $value['price'] * $value['amount']; ?> 
                    <span class="space5">小計</span>：<?php print $price; ?>円
                    <?php $sum += $price; ?>
                  </div>
                  <div class="delete">
                    <input type="submit" value="削除">
                    <input type="hidden" name="data" value="delete_cart">
                    <input type="hidden" name="user_id" value="<?php print $value['user_id']; ?>">
                    <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                    <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                  </div>
                </div>
                </form> 
              </li>
            </ul>
          <?php } ?>
          </div>  
          <form method="post" enctype="multipart/form-data" action="./buy_item.php">
            <div class="container_main_bottom">
              <div class="sum">
                <span class="space6">総計</span>：<?php print $sum; ?>円
              </div>
              <div class="buy">
                <input type="submit" value="購入">
                <input type="hidden" name="data" value="buy_item">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              </div>
            </div>
          </form>

        <div class="link">
          <a href="./items_list.php">戻る(カート内のアイテムは削除されません)</a>
        </div>

      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>