<!-- login_view.php -->
<!-- ログイン画面   -->
<!-- include/gotouchi/view/login_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ログイン画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'login.css'; ?>">
  </head>
  <body>
    <div class="container">
      <div class="title">ログイン</div>
      <div class="container_main">
<img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">
    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>

        <form method="post" action="./session_login.php">
          <div class="row1">
            <div class="name1">ユーザ名<span class="space1"></span>：</div>
            <div class="input1"><input id="name" type="text" name="name" value="<?php print $cookie_name; ?>" size="20"></div>
          </div>
          <div class="row2">
            <div class="name2">パスワード：</div>
            <div class="input2"><input id="password" type="password" name="password" size="20"></div>
          </div>
          <div class="row3">
            <input class="button" type="checkbox" name="cookie_check" value="checked" <?php print $cookie_check; ?> >次回からユーザ名の入力を省略
          </div>
          <div class="row4">
            <input class="button" type="submit" name="login" value="ログイン">
          </div>
        </form>
        <form method="post" action="./register.php" enctype="multipart/form-data">
          <div class="row5">
            <input class="button" type="submit" name="join" value="新規登録">
          </div>
        </form>
      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>