<!-- manage_items_view.php -->
<!-- 商品管理画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_PATH . 'manage_items.css'; ?>">
  </head>
  <body class="text-center">
    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
      <div class="container">
        <span class="skiplink-text">Skip to main content</span>
      </div>
    </a>    
    <?php include_once VIEW_PATH . 'templates/header_manage_view.php'; ?>    
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">商品管理画面</h1>
      <?php include_once VIEW_PATH . 'templates/messages.php'; ?>    
    </div>
    <form method="post" enctype="multipart/form-data" action="./manage_items_insert.php">
    <div class="container">
    <div class="insert_item">
      <h1 class="h3 mb-3 font-weight-normal left">商品追加</h1>
      <h6 class="left"><label for="name">商品名</label></h6>
      <input id="name" class="form-control" type="text" name="insert_name" placeholder="例：ご当地 太郎" size="20" required autofocus>   
      <h6 class="left"><label for="type">種類</label></h6>
      <select name="insert_type" id="type" class="form-control">
        <option value="default">選択してください</option>
        <?php foreach($types as $value) { ?>
        <option value="<?php print $value['id']; ?>"><?php print $value['type_name']; ?></option>
        <?php } ?>
      </select>
      <h6 class="left"><label for="area">産地</label></h6>
      <select name="insert_area" id="area" class="form-control">
        <option value="default">選択してください</option>
        <?php foreach($areas as $value) { ?>
        <option value="<?php print $value['id']; ?>"><?php print $value['area_name']; ?></option>
        <?php } ?>
      </select>
      <h6 class="left"><label for="price">価格 (円)</label></h6>
      <input type="text" name="insert_price" id="price" class="form-control" placeholder="例：1000" required autofocus>
      <h6 class="left"><label for="stock">在庫 (個)</label></h6>
      <input type="text" name="insert_stock" id="stock" class="form-control" placeholder="例：120" required autofocus> 
      <h6 class="left"><label for="status">公開ステータス</label></h6>
      <select name="insert_status" id="status" class="form-control">
        <option value="default">選択してください</option>
        <option value="1">公開</option>
        <option value="0">非公開</option>
      </select>
      <h6 class="left"><label for="image">画像</label></h6>
      <input type='file' name='insert_image' id="image">
      <h6 class="left"><label for="comment">コメント</label></h6>
      <textarea name="insert_comment" placeholder="comment" id="comment" class="form-control"></textarea>
      <div class="button">
        <input type="submit" value="商品を追加する" class="btn btn-primary btn-block"> 
        <input type="hidden" name="data" value="insert">
        <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
        <input type="hidden" name="page" value="<?php print $page; ?>">
      </div>
    </div>
    </div>
    </form>
    <div class="container">
      <h1 class="h3 mb-3 font-weight-normal left">
        商品一覧
        <?php if($count > 0) { ?>
          (全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)
        <?php } ?>        
      </h1>      
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
              <th>商品画像</th>
              <th>商品名</th>
              <th>種類</th>
              <th>産地</th>
              <th>価格(円)</th>
              <th>在庫(個)</th>
              <th>コメント</th>
              <th>公開フラグ</th>
              <th>得点</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($datas as $value) { ?>
          <tr>
            <td><img src=<?php print ITEM_PATH . hsc($value['img']); ?>></td>
            <td><?php print hsc($value['name']); ?></td>
            <td><?php print $value['type']; ?></td>
            <td><?php print $value['area']; ?></td>
            <td><?php print $value['price']; ?></td>
            <form method="post" enctype="multipart/form-data" action="./manage_items_update_stock.php">
            <td>
              <input type="text" name="update_stock" class="form-control" placeholder="<?php print $value['stock']; ?>">
              <input type="submit" value=" 変更" class="btn btn-primary btn-block">
              <input type="hidden" name="data" value="update_stock">
              <input type="hidden" name="id" value="<?php print $value['id']; ?>">     
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              <input type="hidden" name="page" value="<?php print $page; ?>">
            </td>
            </form>
            <form method="post" enctype="multipart/form-data" action="./manage_items_update_comment.php">
            <td>
              <textarea name="update_comment" class="form-control" placeholder="<?php print hsc($value['comment']); ?>"></textarea>
              <input type="submit" value=" 変更" class="btn btn-primary btn-block">
              <input type="hidden" name="data" value="update_comment">
              <input type="hidden" name="id" value="<?php print $value['id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              <input type="hidden" name="page" value="<?php print $page; ?>">
            </td>
            </form>
            <form method="post" enctype="multipart/form-data" action="./manage_items_update_status.php">
            <td class="table_center">
              <?php if($value['status'] === 1) { ?>  
                <input type="submit" name="update_status" value="公開 → 非公開" class="btn btn-primary btn-block">
                <input type="hidden" name="data" value="update_status">
                <input type="hidden" name="status" value="private">
                <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              <?php } else { ?>
                <input type="submit" name="update_status" value="非公開 → 公開" class="btn btn-danger btn-block">
                <input type="hidden" name="data" value="update_status">
                <input type="hidden" name="status" value="public">
                <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              <?php } ?>
            </td>
            </form>
            <td>
              <?php print round($value['review_point'], 2); ?>
            </td>
　　　　    <form method="post" enctype="multipart/form-data" action="./manage_items_delete_items.php">
            <td>
              <input type="submit" value="削除" class="btn btn-danger btn-block">
              <input type="hidden" name="data" value="delete_items">
              <input type="hidden" name="item_id" value="<?php print $value['id']; ?> ">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
              <input type="hidden" name="page" value="<?php print $page; ?>">
            </td>
            </form>
          </tr>
          <?php } ?>
        </tbody>
      </table> 
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
　　　  <form method="post" action="./manage_items.php">
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
　　　　<form method="post" action="./manage_items.php">
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
  </body>
</html>