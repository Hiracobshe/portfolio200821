<!-- header_user_view.php -->
<!-- ヘッダー (ログイン中) -->
<!-- include/gotouchi/view/header_user_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/common_user.css">
  </head>
  <body>
    　   <div class="container_header">
          <div class="container_header_logo">
            <img src="./icon/logo.jpg">
          </div>
          <div class="container_header_message">
            ようこそ<a href="./buy_history.php"><?php print $username; ?></a>さん！
          </div>
          <div class="container_header_cart">
          <form method="post" enctype="multipart/form-data" action="./cart_detail.php">
            <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
            <input type="hidden" name="data" value="update_cart">            
            <input type="image" name="image" src="<?php print "./icon/cart.png"; ?>" alt="カートを確認する" width="25%">            
          </form>
          </div>
          <div class="container_header_logout">
      　     <a href="./session_logout.php">ログアウト</a>
          </div>
        </div>
  </body>
</html>