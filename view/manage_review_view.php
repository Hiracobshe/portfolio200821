<!-- manage_review_view.php -->
<!-- レビュー履歴管理画面 -->
<!-- include/gotouchi/view/manage_review_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>レビュー履歴管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="./CSS/manage_review.css">
  </head>
  <body>
    <div class="manage_container">
      <ul class="container_header">
        <li class="link"><a href="manage_items.php">商品管理画面</li>
        <li class="link"><a href="manage_user.php">ユーザ管理画面</a></li>
        <li class="link"><a href="manage_buy.php">購入履歴管理画面</a></li>
        <li class="header_navi">レビュー履歴管理画面</li>
        <li class="link"><a href="./session_logout.php">ログアウト</a></li>
      </ul>
      <div id="container_main">
        <div class="title">レビュー履歴管理画面(全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)</div>
        <table>
          <tr>
            <th>ユーザID</th>
            <th>ユーザ名</th>
            <th>商品ID</th>
            <th>評価</th>
            <th>コメント</th>
          </tr>
          <?php foreach($datas as $value) { ?>
          <tr>
            <td class="table_center"><?php print $value['user_id']; ?></td>
            <td class="table_center"><?php print $value['user_name']; ?></td>
            <td class="table_center"><?php print $value['item_id']; ?></td>
            <td class="table_center"><?php print $value['point']; ?>点/5</td>
            <td class="table_left"><?php print $value['comment']; ?></td>
          </tr>
          <?php } ?>
        </table>
        <table class="page">
          <tr>
            <td class="page">
              <?php if($prev_page === 0) { ?>
                <<前のページへ
              <?php } else { ?>
　　　        <form method="post" enctype="multipart/form-data" action="./manage_review.php">
                <input type="submit" value="<<前のページへ">
                <input type="hidden" name="page" value="<?php print $page - 1; ?>">
              </form>                
            <?php } ?>
            </td>
            <td class="page">
              ｜
            </td>
            <td class="page">
              <?php if($next_page === 0) { ?>
                次のページへ>>
              <?php } else { ?>
　　　        <form method="post" enctype="multipart/form-data" action="./manage_review.php">
                <input type="submit" value="次のページへ>>">
                <input type="hidden" name="page" value="<?php print $page + 1; ?>">
              </form>                 
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </body>
</html>