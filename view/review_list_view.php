<!-- review_list_view.php -->
<!-- レビュー一覧画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー一覧 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'review_list.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <main>
      <div class="container review">
        <h1 class="h3 mb-3 font-weight-normal left">レビュー一覧</h1>
        <div class="row">
          <div class="col-md-4 order-md-1">
            <img src="<?php print ITEM_PATH . hsc($data1[0]['img']); ?>">
          </div>
          <div class="col-md-8 order-md-2 mb-4">
            <table class="table table-borderless table-dark">
              <thead>
                <tr class="table-info">
                  <th colspan="2" scope="col"><?php print hsc($data1[0]['name']); ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    評価
                  </td>
                  <td>
                    ★<?php print $rating; ?>/5&nbsp;
                  </td>
                </tr>
                <tr>
                  <td>産地</td>
                  <td><?php print $data1[0]['area_name']; ?></td>
                </tr>
                <tr>
                  <td>価格</td>
                  <td><?php print $data1[0]['price']; ?>円</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>        
      </div>
      <div class="container review">
        <?php foreach($data3 as $value) { ?>          
        <div class="review left">
          <h5><?php print hsc($value['comment']) . '<br>'; ?></h5>
          <h6><?php print hsc($value['user_name']); ?>&nbsp;(★<?php print $value['point'] . '/5)&nbsp;&nbsp;&nbsp;' . $value['createdate'] . '<br>'; ?></h6>
        </div>
        <?php } ?>        
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