<!-- header_user_view.php -->
<!-- ヘッダー (管理画面) -->
<header>
  <div class="bg-gotouchi collapse show" id="navbarHeader" style="">
    <div class="container">
      <div class="d-flex">
        <div class="flex-fill">
          <a href="./manage_items.php">
            <button class="btn btn-primary btn-block" type="submit">商品管理画面</button>
          </a>
        </div>
        <div class="flex-fill">
          <a href="./manage_user.php">
            <button class="btn btn-primary btn-block" type="submit">ユーザ管理画面</button>
          </a>
        </div>
        <div class="flex-fill">
          <a href="./manage_buy.php">
            <button class="btn btn-primary btn-block" type="submit">購入履歴管理画面</button>
          </a>
        </div>
        <div class="flex-fill">
          <a href="./manage_review.php">
            <button class="btn btn-primary btn-block" type="submit">レビュー履歴管理画面</button>
          </a>
        </div>
        <div class="flex-fill">
          <a href="./session_logout.php">
            <button class="btn btn-danger btn-block" type="submit">ログアウト</button>
          </a>
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