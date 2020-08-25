<!-- review_edit_view.php -->
<!-- レビュー編集画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー編集 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'review_edit.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>
    <?php include_once VIEW_PATH . 'templates/header_user_view.php'; ?>

    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">レビューを投稿する</h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
      <div class="row">
        <div class="col-md-4 order-md-1">
          <img src="<?php print ITEM_PATH . $data[0]['img']; ?>">
        </div>
        <div class="col-md-8 order-md-2 mb-4">
          <table class="table table-borderless table-dark">
            <thead>
              <tr class="table-info">
                <th colspan="2" scope="col"><?php print $data[0]['name']; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>産地</td>
                <td><?php print $data[0]['area_name']; ?></td>
              </tr>
              <tr>
                <td>価格</td>
                <td><?php print $data[0]['price']; ?>円</td>
              </tr>
            </tbody>
          </table>            
        </div>
      </div>      
    </div>
    <div class="container review">
    <form method="post" enctype="multipart/form-data" action="./review_ok.php">
      <table class="table table-borderless table-dark">
        <tbody>
          <tr>
            <td>
              評価(必須)
            </td>
            <td>
              <select name="rating">
                <option value="default">選択</option>
                <option value="5">5点(とても満足)</option>
                <option value="4">4点(やや満足)</option>
                <option value="3">3点(普通)</option>
                <option value="2">2点(やや不満)</option> 
                <option value="1">1点(とても不満)</option> 
              </select>
            </td>
          </tr>
          <tr>
            <td>投稿者名(必須)</td>
            <td><input type="text" name="postname" placeholder="例：ご当地太郎" size="30"></td>
          </tr>
          <tr>
            <td colspan="2">コメント(任意・500字以内)</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="comment" rows="5" cols="60" placeholder="ここにコメントを記入してください。"></textarea> </td>                
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" value="投稿" class="btn btn-primary">
              <input type="hidden" name="item_id" value="<?php print $data[0]['item_id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">                  
            </td>
          </tr>              
        </tbody>
      </table>
    </form>
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
  </body>
</html>