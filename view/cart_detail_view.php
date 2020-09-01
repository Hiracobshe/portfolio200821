<!-- cart_detail_view.php -->
<!-- 購入内容確認画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入内容確認 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'cart_detail.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>    
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <div class="container">
    <h1 class="h3 mb-3 font-weight-normal left">購入内容確認</h1>
    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
    <?php $sum   =    0; ?>
    <?php foreach($datas as $value) { ?>
    <div class="row">
      <div class="col-md-4 order-md-1">
        <img src="<?php print ITEM_PATH . hsc($value['img']); ?>">
      </div>
      <div class="col-md-8 order-md-2 mb-4">
        <table class="table table-borderless table-dark">
          <thead>
            <tr class="table-info">
              <th colspan="2" scope="col"><?php print hsc($value['name']); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>産地</td>
              <td><?php print $value['area_name']; ?></td>
            </tr>                
            <tr>
              <td>価格</td>
              <td><?php print $value['price']; ?>円</td>
            </tr>
            <tr>
            <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
              <td>
                <input type="text"  name="buy"  value="<?php print $value['amount'];?>"    size="4">個
              </td>
              <td>
                <input type="submit" value="変更" class="btn btn-primary">  
                <input type="hidden" name="data" value="update_cart">
                <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              </td>
            </form>
            </tr>
            <tr>
              <td>
                小計
              </td>
              <td>
                <?php print $value['price'] * $value['amount']; ?>円
                <?php $sum += $value['price'] * $value['amount']; ?>
              </td>
            </tr>
            <tr>
            <form method="post" enctype="multipart/form-data" action="./cart_detail_delete_cart.php">
              <td colspan="2">
                <input type="submit" value="削除" class="btn btn-danger">
                <input type="hidden" name="data" value="delete_cart">
                <input type="hidden" name="user_id" value="<?php print $value['user_id']; ?>">
                <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              </td>
            </form>
            </tr>
          </tbody>
        </table>            
          </div>
        </div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data" action="./buy_item.php">        
        <div class="row">
        <?php if($sum > 0) { ?>
          <div class="col-md-6 mb-3">
            <h4>総計：<?php print $sum; ?>円</h4>
          </div>
          <div class="col-md-6 mb-3">
            <input type="submit" value="購入" class="btn btn-primary">
            <input type="hidden" name="data" value="buy_item">
            <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">            
          </div>     
        <?php } ?>
      </div>
      </form>
    </div>
    <div class="container">
      <a href="./items_list.php" class="btn btn-primary">戻る(カート内のアイテムは削除されません)</a>
    </div>
    <footer>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>      
    </footer>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/anchor.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/clipboard.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/bs-custom-file-input.min.js"></script>
    <script src="/docs/4.5/assets/js/src/application.js"></script>
    <script src="/docs/4.5/assets/js/src/search.js"></script>
    <script src="/docs/4.5/assets/js/src/ie-emulation-modes-warning.js"></script>
  </body>
</html>