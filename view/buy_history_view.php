<!-- buy_history_view.php -->
<!-- 購入履歴画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'buy_history.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">購入履歴</h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
      <?php foreach($datas as $value) { ?>
      <div class="row">
        <div class="col-md-4 order-md-1 image">
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
                <td>購入日時</td>
                <td><?php print $value['createdate']; ?></td>
              </tr>                
              <tr>
                <td>価格</td>
                <td><?php print $value['price']; ?>円</td>
              </tr>
              <tr>
                <td>個数</td>
                <td><?php print $value['amount']; ?>個</td>
              </tr>
              <tr>
                <td>計</td>
                <td><?php print (int)$value['price'] * (int)$value['amount']; ?>円</td>
              </tr>
              <tr>
                <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
                <td>
                <?php if($value['stock'] > 0) { ?>
                  <input class="btn btn-primary" type="submit", value="カートに追加">
                  <input type="hidden" name="data" value="update_cart">
                  <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                  <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <?php } else { ?>
                  <h6>在庫切れ</h6>
                <?php } ?>
                </td>
                </form>
                <form method="post" enctype="multipart/form-data" action="./review_edit.php">
                <td>
                <?php if($value['review_flag'] === 0) { ?>
                  <input class="btn btn-primary" type="submit", value="レビュー">
                  <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
                  <input type="hidden" name="createdate" value="<?php print $value['createdate']; ?>">
                <?php } else { ?>
                  <h6>レビュー済</h6>
                <?php } ?>
                </td>
                </form>
              </tr>
            </tbody>
          </table>            
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="text-center">
      <a href="./items_list.php" class="btn btn-primary">商品一覧へ</a>
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