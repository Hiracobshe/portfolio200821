<!-- register_ok_view.php -->
<!-- ユーザー登録完了画面   -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ユーザー登録完了 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'register_ok.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <form class="form-signin" action="./session_login.php" method="post">
      <img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">
      <h1 class="h3 mb-3 font-weight-normal">ユーザ登録完了</h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
    　<button class="btn btn-lg btn-primary btn-block" type="submit">買い物を始める</button>
      <input type="hidden" name="name" value="<?php print $name; ?>">
      <input type="hidden" name="password" value="<?php print $password1; ?>">
    </form>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
  </body>
</html>