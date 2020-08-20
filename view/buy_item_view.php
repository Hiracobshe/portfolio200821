<!-- buy_item_view.php -->
<!-- 購入完了画面 -->
<!-- include/gotouchi/view/buy_item_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入完了画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'buy_item.css'; ?>">
  </head>
  <body>
    <div class="container">
    <?php include_once './view/header_user_view.php'; ?> 
      <div class="container_main">
      <?php if(isset($err_acc)) { ?>
        <div class="err_msg"><?php print $err_acc; ?></div>
      <?php } else { ?>
        <div class="container_main_top">
          <div class="title">購入手続き完了</div>
<?php include_once VIEW_PATH . 'templates/messages.php'; ?>

        </div>
        <div class="container_main_middle">
        <?php $sum = 0; ?>
        <?php foreach($datas as $value) { ?>
          <ul>      
            <li class="container_main_left">
              <div class="l_row1"><img src="./image/<?php print $value['img']; ?>"></div>
            </li>    
            <li class="container_main_right">
              <div class="r_row1">商品名：<?php print $value['name']; ?></div>
              <div class="r_row2"><span class="space2">産地</span>：<?php print $value['area_name']; ?></div>
              <div class="r_row3">
                <div class="price"><span class="space3">価格</span>：<?php print $value['price']; ?>円</div>
                <div class="number">個数：<?php print $value['amount'];?>個</div>
              </div>
              <div class="r_row4">
                <?php $price = $value['price'] * $value['amount']; ?>
                <div><span class="space4">小計</span>：<?php print $price; ?>円</div>
                <?php $sum += $price; ?>
              </div>
            </li>  
          </ul>
        <?php } ?>
        </div>
        <div class="container_main_bottom">
          <div class="total">総計：<?php print $sum; ?>円</div>      
          <div class="link"><a href="./buy_history.php">購入履歴へ</a></div>
          <div class="link"><a href="./items_list.php">引き続き買い物を続ける</a></div>
        </div>
      <?php } ?>
      </div>
    <?php include_once './view/footer_view.php'; ?>
    </div>
  </body>
</html>