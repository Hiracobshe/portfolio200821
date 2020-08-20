<!-- manage_user_view.php -->
<!-- ユーザー管理画面 -->
<!-- include/gotouchi/view/manage_user_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>ユーザー管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="./CSS/manage_user.css">
  </head>
  <body>
    <div class="manage_container">
      <ul class="container_header">
        <li class="link"><a href="manage_items.php">商品管理画面</a></li>
        <li class="header_navi">ユーザ管理画面</li>
        <li class="link"><a href="manage_buy.php">購入履歴管理画面</a></li>
        <li class="link"><a href="manage_review.php">レビュー履歴管理画面</a></li>
        <li class="link"><a href="./session_logout.php">ログアウト</a></li>
      </ul>
      <div class="container_main">
        <div class="title">ユーザ管理画面(全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)</div>
        <table>
          <tr>
            <th>ユーザID</th>
            <th>ユーザ名</th>
            <th>パスワード</th>
            <th>メールアドレス</th>
            <th>郵便番号</th>
            <th>住所</th>
            <th>生年月日</th>
            <th>登録日時</th>
          </tr>
          <?php foreach($datas as $value) { ?>
          <tr>
            <td class="table_center"><?php print $value['id']; ?></td>
            <td class="table_center"><?php print $value['username']; ?></td>
            <td class="table_left"><?php print $value['password']; ?></td>
            <td class="table_left"><?php print $value['mail']; ?></td>
            <td class="table_left"><?php print $value['post']; ?></td>
            <td class="table_left"><?php print $value['address']; ?></td>
            <td class="table_center"><?php print $value['birthdate']; ?></td>
            <td class="table_center"><?php print $value['createdate']; ?></td>
          </tr>
          <?php } ?>
        </table>
        <table class="page">
          <tr>
            <td class="page">
              <?php if($prev_page === 0) { ?>
                <<前のページへ
              <?php } else { ?>
　　　        <form method="post" enctype="multipart/form-data" action="./manage_user.php">
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
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_user.php">
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