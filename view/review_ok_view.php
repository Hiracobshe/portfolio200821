<!-- review_ok_view.php -->
<!-- レビュー編集完了画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー編集完了 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'review_ok.css'; ?>">
  </head>
  <body class="text-center">
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">レビュー投稿完了</h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
    </div>
    <div class="container button">
      <a href="./buy_history.php" class="btn btn-primary">購入履歴へ</a>
    </div>
    <div class="container button">
       <a href="./items_list.php" class="btn btn-primary">引き続き買い物を続ける</a>
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