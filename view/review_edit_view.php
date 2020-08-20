<!-- review_edit_view.php -->
<!-- レビュー編集画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>レビュー編集 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'review_edit.css'; ?>">
  </head>
  <body>
    <div class="container">  
    <?php include_once VIEW_PATH . 'header_user_view.php'; ?>
      <div class="container_main">
        <div class="container_main_top">
          <div class="title">レビュー編集</div>   
        </div>
<?php include_once VIEW_PATH . 'templates/messages.php'; ?>
        <div class="container_main_middle">
          <div class="containre_main_left">
            <div class="l_row1">
              <img src="./image/<?php print $data[0]['img']; ?>">            
            </div>
          </div>
          <div class="container_main_right">
            <div class="r_row1">
              商品名：<?php print $data[0]['name']; ?>
            </div>
            <div class="r_row2">
              <span class="space2">産地</span>：<?php print $data[0]['area_name']; ?>
            </div>
            <div class="r_row3">
              <span class="space3">価格</span>：<?php print $data[0]['price']; ?>円
            </div>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" action="./review_ok.php">
          <div class="container_main_bottom">
            <div class="b_row1">
              <span class="b_space1">評価</span>(必須)：
              <select name="rating">
                <option value="default">選択</option>
                <option value="5">5点(とても満足)</option>
                <option value="4">4点(やや満足)</option>
                <option value="3">3点(普通)</option>
                <option value="2">2点(やや不満)</option> 
                <option value="1">1点(とても不満)</option> 
              </select>
            </div>
            <div class="b_row2">
              投稿者名(必須)：<input type="text" name="postname" placeholder="例：ご当地太郎" size="30"> 
            </div>
            <div class="b_row3">
              コメント(任意・500字以内)：
            </div>
            <div class="b_row4">
              <textarea name="comment" rows="5" cols="60" placeholder="ここにコメントを記入してください。"></textarea>            
            </div>
            <div class="b_row5 center">
              <input type="submit" value="投稿">
              <input type="hidden" name="item_id" value="<?php print $data[0]['item_id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
            </div>
          </div>
        </form>
      </div>     
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>