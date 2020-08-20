<!-- manage_buy_view.php -->
<!-- 購入履歴管理画面 -->
<!-- include/gotouchi/view/manage_buy_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>購入履歴管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="./CSS/manage_buy.css">
  </head>
  <body>
    <div class="manage_container">
      <ul class="container_header">
        <li class="link"><a href="manage_items.php">商品管理画面</a></li>
        <li class="link"><a href="manage_user.php">ユーザ管理画面</a></li>
        <li class="header_navi">購入履歴管理画面</li>
        <li class="link"><a href="manage_review.php">レビュー履歴管理画面</a></li>
        <li class="link"><a href="./session_logout.php">ログアウト</a></li>
      </ul>
      <div class="container_main">
        <div class="title">購入履歴管理画面(全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)</div>
        <table>
          <tr>
            <th>ユーザID</th>
            <th>商品ID</th>
            <th>購入商品数</th>
            <th>金額</th>
            <th>レビューフラグ</th>
          </tr>
          <?php foreach($datas as $value) { ?>
            <tr>
              <td class="table_center"><?php print $value['user_id']; ?></td>
              <td class="table_center"><?php print $value['item_id']; ?></td>
              <td class="table_right"><?php print $value['amount']; ?>個</td>
              <td class="table_right"><?php print $value['price']; ?>円</td>
              <td class="table_center"><?php print $value['review_flag']; ?></td>
            </tr>
          <?php } ?>
        </table>
        <table class="page">
          <tr>
            <td class="page">
              <?php if($prev_page === 0) { ?>
                <<前のページへ
              <?php } else { ?>
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_buy.php">
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
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_buy.php">
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