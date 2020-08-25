<!-- login_view.php -->
<!-- ログイン画面   -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ログイン画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'login.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <form class="form-signin" action="./session_login.php" method="post">
      <img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
      <h1 class="h3 mb-3 font-weight-normal">サインインする</h1>
      <label for="name" class="sr-only">ユーザ名</label>
      <input id="name" class="form-control" type="text" name="name" value="<?php print $cookie_name; ?>" size="20" placeholder="ユーザ名" required autofocus>
      <label for="password" class="sr-only">パスワード</label>     
      <input id="password" class="form-control" type="password" name="password" size="20" placeholder="パスワード" required>
      <div class="checkbox mb-3">
        <label><input class="button" type="checkbox" name="cookie_check" value="checked" <?php print $cookie_check; ?>>次回からユーザ名の入力を省略</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">サインイン</button>
    </form>
    <form class="form-signin" action="./register.php" method="post">
      <button class="btn btn-lg btn-primary btn-block" type="submit">新規登録</button>
    </form>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
  </body>
</html>