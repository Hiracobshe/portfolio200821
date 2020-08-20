<!-- resister_view.php -->
<!-- ユーザー登録画面   -->
<!-- include/gotouchi/view/resister_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>ユーザー登録画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'register.css'; ?>">
  </head>
  <body>
    <div class="container">
      <div class="title">ユーザー新規登録</div>
      <div class="container_main">
<img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT">
    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
        <form method="post" action="./register_ok.php" enctype="multipart/form-data">
          <div class="row1">
            <div class="name1">ユーザ名<span class="space1_1"></span>：</div>
            <div class="input1"><input id="name" type="text" name="name" placeholder="必須" size="20"></div>
          </div>  
          <div class="row2">    
            <div class="name2">パスワード<span class="space2_1"></span>：</div>
            <div class="input2"><input id="password1" type="password" name="password1" placeholder="必須" size="20"></div>
          </div>  
          <div class="row3">
            <div class="name3">パスワード(再入力)：</div>
            <div class="input3"><input id="password2" type="password" name="password2" placeholder="必須" size="20"></div>
          </div>
          <div class="row4">    
            <div class="name4">メールアドレス<span class="space4_1"></span>：</div>
            <div class="input4"><input id="mail" type="text" name="mail" placeholder="必須" size="50"></div>
          </div>
          <div class="row5">    
            <div class="name5">郵便番号<span class="space5_1"></span>：</div>
            <div class="input5"><input id="number" type="text" name="number" placeholder="必須" size="7"></div>
          </div>    
          <div class="row6">    
            <div class="name6">住所<span class="space6_1"></span>：</div>
            <div class="input6"><input id="address" type="text" name="address" placeholder="必須" size="50"></div>
          </div>    
          <div class="row7">    
            <div class="name7">性別<span class="space7_1"></span>：</div>
            <div class="input7">          
              <select name="sex">
                <option value="default">選択</option>
                <option value="1">男性</option>
                <option value="2" >女性</option>
                <option value="3" >その他</option>                  
              </select>
            </div>
          </div>    
          <div class="row8">    
          <div>生年月日(任意)<span class="space8_1"></span>：</div>
            <div class="input8">
              <select name="birth_year">
                <option value="default">選択</option>
                <?php for($lp1=2020; 1900<=$lp1; $lp1--) { ?>
                  <option value="<?php print $lp1; ?>"> <?php print $lp1; ?></option>
                <?php } ?>  
              </select>年
              <select name="birth_month">
                <option value="default">選択</option>
                <?php for($lp1=1; $lp1<=12; $lp1++) { ?>
                  <option value="<?php print $lp1; ?>"> <?php print $lp1; ?></option>
                <?php } ?>  
              </select>月
              <select name="birth_day">
                <option value="default">選択</option>
                <?php for($lp1=1; $lp1<=31; $lp1++) { ?>
                  <option value="<?php print $lp1; ?>"> <?php print $lp1; ?></option>
                <?php } ?>  
              </select>日
            </div>
          </div>  
          <div class="row9"><input class="button" type="submit" name="join" value="新規登録"></div>
        </form>
      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>