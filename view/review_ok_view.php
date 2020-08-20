<!-- review_ok_view.php -->
<!-- レビュー編集完了画面 -->
<!-- include/gotouchi/view/review_ok_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>レビュー編集完了 - Gotouchi</title>
    <link rel="stylesheet" href="./CSS/review_ok.css">
  </head>
  <body>
    <div class="container">
    <?php include_once './view/header_user_view.php'; ?> 
      <div class="container_main">
            <div class="container_main_top">
              <div class="title">レビュー編集完了</div>
            </div>
            <div class="container_main_middle">
              <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
            </div>
            <div class="container_main_bottom">
              <div class="link"><a href="./buy_history.php">購入履歴へ</a></div>
              <div class="link"><a href="./items_list.php">引き続き買い物を続ける</a></div>
            </div>
      </div>
    <?php include_once './view/footer_view.php'; ?>
    </div>  
  </body>
</html>