<!-- items_list_view.php -->
<!-- 商品一覧画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品一覧画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'items_list.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>
    <main>
      <div class="container">
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
        <h1 class="h3 mb-3 font-weight-normal left">アナタへのオススメ商品</h1>      
        <div class="item_cell">
        <?php $lp1 = 0; ?>
          <ul class="list-unstyled">
          <?php foreach($datas as $value) { ?>
            <li class="item_detail">
              <h4 class="left name"><a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><?php print hsc($value['name']); ?></a></h4>
              <h6 class="left">産地：<?php print $value['area_name']; ?></h6>
              <h6 class="left">カテゴリ：<?php print $value['type_name']; ?></h6>
              <div class="d-flex">
                <?php if($value['review_point'] === (float)0) { ?>
                <div class="flex-fill">
                  <h6 class="center empty">★-/5<span class="t_space4"></span></h6>
                </div>
                <div class="flex-fill">
                  <h6 class="center empty"></h6> 
                </div>
                <?php } else { ?>
                <div class="flex-fill">
                  <h6>★<?php print round($value['review_point'], 2); ?>/5</h6>
                </div>
                <div class="flex-fill">
                  <form method="post" enctype="multipart/form-data" action="./review_list.php">
                    <input class="btn btn-primary" type="submit" value="レビュー">
                    <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                  </form>
                </div>
                <?php } ?>
              </div> 
              <div class="center">
                <a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><img src="<?php print IMG_DIR . hsc($value['img']); ?>"></a>
              </div>
              <div class="d-flex">
                <div class="flex-fill">
                  <h6><?php print $value['price']; ?>円</h6>
                </div>
                <?php if($value['stock'] > 0) { ?>
                <div class="flex-fill">
                  <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
                    <input class="btn btn-primary" type="submit" value="カートに入れる">
                    <input type="hidden" name="data" value="update_cart">
                    <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                    <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>"> 
                  </form>
                </div>
                <?php } else { ?>
                <div class="flex-fill">
                  <h6>在庫切れ</h6>                
                </div>
                <?php } ?>
              </div>
              </li>
              <?php $lp1++; ?>
            <?php } ?>
            <?php while($lp1 % MAX_ITEMS_PER_ROW !== 0) { ?>
            <li class="empty"></li>
            <?php $lp1++; ?>
          <?php } ?>
          </ul>
        </div>
      </div>
      <div class="container">
        <h1 class="h3 mb-3 font-weight-normal left">検索</h1>
        <form method="post" action="./items_list_search.php">        
          <table class="table table-borderless table-dark">
            <tbody>
              <tr>
                <td>
                  <h6>カテゴリ</h6>
                  <select name="check_type">
                    <option value="default">選択</option>
                    <?php foreach($data2 as $value) { ?>
                    <option value="<?php print $value['id']; ?>"><?php print $value['type_name']; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td>
                  <h6>産地</h6>
                  <select name="check_area">
                    <option value="default">選択</option>
                    <?php foreach($data3 as $value) { ?>
                    <option value="<?php print $value['id']; ?>"><?php print $value['area_name']; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td>
                  <h6>キーワード</h6>
                  <input id="text_keyword" type="text" name="keyword" placeholder="例：大吟醸" size="20">
                </td>
              </tr>
              <tr>
                <td>
                  <h6>並べ替え</h6>
                    <select id="check_sort" name="check_sort">
                      <option value="default">選択</option>
                      <option value="rating_high">評価が高い順</option>
                      <option value="price_low">値段が安い順</option>
                      <option value="price_high">値段が高い順</option>
                      <option value="update_new">登録が新しい順</option>
                    </select> 
                </td>
                <td>
                  <input class="btn btn-primary" type="submit" value="検索">
                  <input type="hidden" name="search_items" value="search_items">
                  <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>"> 
                </td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
      <div class="container">
          <?php if(isset($data4)) { ?>
        <h1 class="h3 mb-3 font-weight-normal left">
          検索結果
          <?php if($count > 0) { ?>
          (全<?php print $count; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)
          <?php } ?>
        </h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
          <div class="item_cell">
            <?php $lp1 = 0; ?>
              <ul class="list-unstyled">
              <?php foreach($data4 as $value) { ?>
                <li class="item_detail">
                  <h4 class="left name"><a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><?php print hsc($value['name']); ?></a></h4>
                  <h6 class="left">産地：<?php print $value['area_name']; ?></h6>
                  <h6 class="left">カテゴリ：<?php print $value['type_name']; ?></h6>
                  <div class="d-flex">
                  <?php if($value['review_point'] === (float)0) { ?>
                    <div class="flex-fill">
                      <h6 class="center empty">★-/5<span class="t_space4"></span></h6>
                    </div>
                    <div class="flex-fill">
                      <h6 class="center empty"></h6> 
                    </div>
                  <?php } else { ?>
                    <div class="flex-fill">
                      <h6>★<?php print round($value['review_point'], 2); ?>/5</h6>
                    </div>
                    <div class="flex-fill">
                      <form method="post" enctype="multipart/form-data" action="./review_list.php">
                        <input class="btn btn-primary" type="submit" value="レビュー">
                        <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                      </form>
                    </div>
                  <?php } ?>
                  </div> 
                  <div class="center">
                    <a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><img src="<?php print IMG_DIR . hsc($value['img']); ?>"></a>
                  </div>
                  <div class="d-flex">
                    <div class="flex-fill">
                      <h6 class="price"><?php print $value['price']; ?>円</h6>
                    </div>
                    <?php if($value['stock'] > (float)0) { ?>
                    <div class="flex-fill">
                      <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">
                        <input class="btn btn-primary" type="submit" value="カートに入れる">
                        <input type="hidden" name="data" value="update_cart">
                        <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                        <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>"> 
                      </form>
                    </div>
                    <?php } else { ?>
                    <div class="flex-fill">
                      <h6>在庫切れ</h6>                
                    </div>
                    <?php } ?>
                  </div>
                </li>
                <?php $lp1++; ?>
                  <?php if($lp1 % MAX_ITEMS_PER_ROW === 0) { ?>
                    </ul><ul>
                  <?php } ?>
              <?php } ?>
              <?php while($lp1 % MAX_ITEMS_PER_ROW !== 0) { ?>
                <li class="empty"></li>
                <?php $lp1++; ?>
              <?php } ?>
              </ul>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
　　　　      <form method="post" enctype="multipart/form-data" action="./items_list_search.php">
              <?php if($prev_page === 0) { ?>
                <input class="btn btn-secondary" type="submit" value="<<前のページへ">
                <input type="hidden" name="page" value="<?php print 1; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="check_type" value="<?php print $check_type; ?>">
                <input type="hidden" name="check_area" value="<?php print $check_area; ?>">
                <input type="hidden" name="keyword" value="<?php print $keyword; ?>">
                <input type="hidden" name="check_sort" value="<?php print $check_sort; ?>">
              <?php } else { ?>
                <input class="btn btn-primary" type="submit" value="<<前のページへ">
                <input type="hidden" name="page" value="<?php print $page - 1; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="check_type" value="<?php print $check_type; ?>">
                <input type="hidden" name="check_area" value="<?php print $check_area; ?>">
                <input type="hidden" name="keyword" value="<?php print $keyword; ?>">
                <input type="hidden" name="check_sort" value="<?php print $check_sort; ?>">
              <?php } ?>
              </form>  
            </div>
            <div class="col-md-6 mb-3">
　　　　      <form method="post" enctype="multipart/form-data" action="./items_list_search.php">
              <?php if($next_page === 0) { ?>
                <input class="btn btn-secondary" type="submit" value="次のページへ>>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="check_type" value="<?php print $check_type; ?>">
                <input type="hidden" name="check_area" value="<?php print $check_area; ?>">
                <input type="hidden" name="keyword" value="<?php print $keyword; ?>">
                <input type="hidden" name="check_sort" value="<?php print $check_sort; ?>">
              <?php } else { ?>
                <input class="btn btn-primary" type="submit" value="次のページへ>>">
                <input type="hidden" name="page" value="<?php print $page + 1; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="check_type" value="<?php print $check_type; ?>">
                <input type="hidden" name="check_area" value="<?php print $check_area; ?>">
                <input type="hidden" name="keyword" value="<?php print $keyword; ?>">
                <input type="hidden" name="check_sort" value="<?php print $check_sort; ?>">
              <?php } ?>
              </form> 
            </div>  
          </div>
        <?php } ?>
      </div>
    </main>
    <footer>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>      
    </footer>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/anchor.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/clipboard.min.js"></script>
    <script src="/docs/4.5/assets/js/vendor/bs-custom-file-input.min.js"></script>
    <script src="/docs/4.5/assets/js/src/application.js"></script>
    <script src="/docs/4.5/assets/js/src/search.js"></script>
    <script src="/docs/4.5/assets/js/src/ie-emulation-modes-warning.js"></script>
  </body>
</html>