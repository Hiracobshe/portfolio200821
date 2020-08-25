<!-- header_user_view.php -->
<!-- ヘッダー (ログイン中) -->
<header>
  <div class="bg-gotouchi collapse show" id="navbarHeader" style="">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">ようこそ<?php print hsc($username); ?>さん！</h4>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li>
            <form method="post" action="./cart_detail.php">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              <input type="hidden" name="data" value="update_cart">            
              <button class="btn btn-primary btn-block" type="submit">カート内商品を見る</button>           
            </form>
            </li>
            <li>
              <a href="./buy_history.php">
                <button class="btn btn-primary btn-block" type="submit">購入履歴</button>
              </a>
            </li>
            <li>
              <a href="./session_logout.php">
                <button class="btn btn-danger btn-block" type="submit">ログアウト</button>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-gotouchi shadow-sm">
    <div class="container d-flex justify-content-between">
        <strong><img class="mb-4" src="<?php print ICON_PATH . 'logo.jpg'; ?>" alt="logo.jpg" width="IMG_LOGO_WIDTH" height="IMG_LOGO_HEIGHT"></strong>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>
