<!-- resister_view.php -->
<!-- ユーザー登録画面   -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ユーザー登録画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'register.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <form class="form-signin" action="./register_ok.php" method="post">
      <img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
      <h1 class="h3 mb-3 font-weight-normal">新規登録</h1>
      <h6 class="left"><label for="name">ユーザ名</label></h6>
      <input id="name" class="form-control" type="text" name="name" placeholder="例：ご当地 太郎" size="20" required autofocus>      
      <h6 class="left"><label for="password1">パスワード</label></h6>
      <input id="password1" class="form-control" type="password" name="password1"  size="20" required autofocus>
      <h6 class="left"><label for="password2">パスワード(再入力)</label></h6>
      <input id="password2" class="form-control" type="password" name="password2" size="20" required autofocus>
      <h6 class="left"><label for="mail">メールアドレス</label></h6>
      <input id="mail" class="form-control" type="text" name="mail" placeholder="例：gotouchi@xxx.com" size="50" required autofocus>
      <h6 class="left"><label for="number">郵便番号</label></h6>
      <input id="number" class="form-control" type="text" name="number" placeholder="例：1234567" size="7" required autofocus>
      <h6 class="left"><label for="address">住所</label></h6>
      <input id="address" class="form-control" type="text" name="address" placeholder="例：XX県YY市ZZ町" size="50" required autofocus>
      <h6 class="left">性別</h6>
      <select name="sex" class="form-control">
        <option value="default">選択</option>
        <option value="1">男性</option>
        <option value="2" >女性</option>
        <option value="3" >その他</option>                  
      </select>
      <h6 class="left">生年月日(任意)</h6>
      <div class="row">
        <div class="col-md-4">年
          <select name="birth_year" class="form-control">
            <option value="default">選択</option>
            <?php for($lp1=2020; 1900<=$lp1; $lp1--) { ?>
            <option value="<?php print $lp1; ?>"> <?php print $lp1 . '年'; ?></option>
            <?php } ?>  
          </select>
        </div>
        <div class="col-md-4">月
          <select name="birth_month" class="form-control">
            <option value="default">選択</option>
            <?php for($lp1=1; $lp1<=12; $lp1++) { ?>
            <option value="<?php print $lp1; ?>"> <?php print $lp1 . '月'; ?></option>
            <?php } ?>  
          </select>
        </div>
        <div class="col-md-4">日
          <select name="birth_day" class="form-control">
            <option value="default">選択</option>
            <?php for($lp1=1; $lp1<=31; $lp1++) { ?>
            <option value="<?php print $lp1; ?>"> <?php print $lp1 . '日'; ?></option>
            <?php } ?>  
          </select>
        </div>
      </div>
    　<button class="btn btn-lg btn-primary btn-block" type="submit">新規登録</button>
      <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </form>
  </body>
</html>