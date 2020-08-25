<!-- manage_buy_view.php -->
<!-- 購入管理画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'manage_buy.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>    
    <?php include_once VIEW_PATH . 'templates/header_manage_view.php'; ?>    
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">購入履歴管理画面
        <?php if($count > 0) { ?>
          (全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)
        <?php } ?>        
      </h1>      
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th>ユーザID</th>
            <th>商品ID</th>
            <th>購入商品数(個)</th>
            <th>金額(円)</th>
            <th>レビューフラグ</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($datas as $value) { ?>
            <tr>
              <td><?php print $value['user_id']; ?></td>
              <td><?php print $value['item_id']; ?></td>
              <td class="table_right"><?php print $value['amount']; ?></td>
              <td class="table_right"><?php print $value['price']; ?></td>
              <td class="table_center"><?php print $value['review_flag']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table> 
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
　　　  <form method="post" action="./manage_buy.php">
          <?php if($prev_page === 0) { ?>
          <input class="btn btn-secondary" type="submit" value="<<前のページへ">
          <input type="hidden" name="page" value="<?php print 1; ?>">
          <?php } else { ?>
          <input class="btn btn-primary" type="submit" value="<<前のページへ">
          <input type="hidden" name="page" value="<?php print $page - 1; ?>">
          <?php } ?>
        </form>  
      </div>
      <div class="col-md-6 mb-3">
　　　　<form method="post" action="./manage_buy.php">
          <?php if($next_page === 0) { ?>
          <input class="btn btn-secondary" type="submit" value="次のページへ>>">
          <input type="hidden" name="page" value="<?php print $page; ?>">
          <?php } else { ?>
          <input class="btn btn-primary" type="submit" value="次のページへ>>">
          <input type="hidden" name="page" value="<?php print $page + 1; ?>">
          <?php } ?>
        </form> 
      </div>  
    </div>     
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
    </div>
  </body>
</html>