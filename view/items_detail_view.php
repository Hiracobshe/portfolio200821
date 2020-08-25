<!-- items_detail_view.php -->
<!-- 商品詳細画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品詳細画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'items_detail.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <main>
      <div class="container">
        <h1 class="h3 mb-3 font-weight-normal left">商品詳細</h1>
        <div class="row">
          <div class="col-md-4 order-md-1">
            <img src="./image/<?php print hsc($data[0]['img']); ?>">
          </div>
          <div class="col-md-8 order-md-2 mb-4">
            <table class="table table-borderless table-dark">
              <thead>
                <tr class="table-info">
                  <th colspan="2" scope="col"><?php print hsc($data[0]['name']); ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <?php if($data2[0]['review_point'] === (float)0) { ?>
                      ★-/5&nbsp;
                    <?php } else { ?>
                      ★<?php print round($data2[0]['review_point'], 2) ?>/5&nbsp;   
                      <?php } ?>
                  </td>
                  <td>
                    <?php if($data2[0]['review_point'] === (float)0) { ?>
                    <?php } else { ?>
                    <form method="post" enctype="multipart/form-data" action="./review_list.php"> 
                      <input class="btn btn-primary" type="submit" value="レビュー">
                      <input type="hidden" name="item_id" value="<?php print $item_id; ?>">
                    </form>             
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><?php print hsc($data[0]['comment']); ?></td>
                </tr>
                <tr>
                  <td>産地</td>
                  <td><?php print $data[0]['area_name']; ?></td>
                </tr>
                <tr>
                  <td>価格</td>
                  <td><?php print $data[0]['price']; ?>円</td>
                </tr>
                <tr>
                  <td colspan="2">
                    <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php"> 
                      <?php if($data[0]['stock'] > 0) { ?>
                      <input class="btn btn-primary" type="submit" value="カートに追加">
                      <?php } else { ?>
                      <div class="center">在庫切れ</div>
                      <?php } ?>
                      <input type="hidden" name="data" value="update_cart">
                      <input type="hidden" name="item_id" value="<?php print $item_id; ?>">
                      <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                    </form>                  
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="container">
        <a href="./items_list.php" class="btn btn-primary">戻る</a>
      </div>
    </main>
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