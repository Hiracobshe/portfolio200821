<!-- register_ok_view.php -->
<!-- ユーザー登録完了画面   -->
<!-- include/gotouchi/view/register_ok_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ユーザー登録完了 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'register_ok.css'; ?>">
  </head>
  <body>
    <div class="container">
<img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">


        <div class="title">ユーザー登録完了</div>
        <div class="container_main">

    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>


          <form method="post" action="./session_login.php">
            <div class="link"><input type="submit" value="買い物を始める"></div>
            <input type="hidden" name="name" value="<?php print $name; ?>">
            <input type="hidden" name="password" value="<?php print $password1; ?>">
          </form>
        </div>

    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>