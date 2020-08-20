<!-- manage_items_view.php -->
<!-- 商品管理画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品管理画面 - Gotouchi</title>
    <link rel="stylesheet" href="./CSS/manage_items.css">
  </head>
  <body>
    <div class="manage_container">
      <ul class="container_header">
        <li class="header_navi">商品管理画面</li>
        <li class="link"><a href="manage_user.php">ユーザ管理画面</a></li>
        <li class="link"><a href="manage_buy.php">購入履歴管理画面</a></li>
        <li class="link"><a href="manage_review.php">レビュー履歴管理画面</a></li>
        <li class="link"><a href="./session_logout.php">ログアウト</a></li>
      </ul>
      <div class="container_main">

        <div class="title">商品管理画面</div>
    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
        <div class="container_main_top">

      
        </div>        
        <div class="container_main_middle">
          <div class="title">商品追加</div>
            <form method="post" enctype="multipart/form-data" action="./manage_items_insert.php">
              <div class="m_row1">
                <span class="m_space1">商品名</span>：
                <input type="text" name="insert_name"> 
              </div>  
              <div class="m_row2">
                <span class="m_space2">種類</span>：
                <select name="insert_type">
                  <option value="default">選択してください</option>
                  <?php foreach($types as $value) { ?>
                    <option value="<?php print $value['id']; ?>"><?php print $value['type_name']; ?></option>
                  <?php } ?>
                </select>               
              </div> 
              <div class="m_row3">
                <span class="m_space3">産地</span>：
                <select name="insert_area">
                  <option value="default">選択してください</option>
                  <?php foreach($areas as $value) { ?>
                    <option value="<?php print $value['id']; ?>"><?php print $value['area_name']; ?></option>
                  <?php } ?>
                </select>
              </div> 
              <div class="m_row4"><span class="m_space4">価格</span>：
                <input type="text" name="insert_price">円            
              </div> 
              <div class="m_row5"><span class="m_space5">在庫</span>：
                <input type="text" name="insert_stock">個
              </div> 
              <div class="m_row6"><span class="m_space6">公開フラグ</span>：
                <select name="insert_status">
                  <option value="default">選択してください</option>
                  <option value="1">公開</option>
                  <option value="0">非公開</option>
                </select>            
              </div> 
              <div class="m_row7"><span class="m_space7">画像</span>：
                <input type='file' name='insert_image'>            
              </div> 
              <div class="m_row8"><span class="m_space8">コメント</span>：
                <textarea name="insert_comment" placeholder="<?php print 'comment'; ?>"></textarea>
              </div> 
              <div class="m_row9">
                <span class="m_space9"></span>
                <input type="submit" value="商品を追加する"> 
                <input type="hidden" name="data" value="insert">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              </div> 
            </form>
         </div>
         <div class="container_main_bottom">
            <div class="title table">商品一覧(全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)</div>
              <table>
                <tr>
                  <th>商品画像</th>
              <th>商品名</th>
              <th>種類</th>
              <th>産地</th>
              <th>価格</th>
              <th>在庫</th>
              <th>コメント</th>
              <th>公開フラグ</th>
              <th>レビューの得点</th>
              <th></th>
            </tr>
            <?php foreach($datas as $value) { ?>
            <tr>
              <td class="table_center"><img src=<?php print './image/' .$value['img']; ?>></td>
              <td class="table_center"><?php print $value['name']; ?></td>
              <td class="table_center"><?php print $value['type']; ?></td>
              <td class="table_center"><?php print $value['area']; ?></td>
              <td class="table_right"><?php print $value['price']; ?>円</td>
              <form method="post" enctype="multipart/form-data" action="./manage_items_update_stock.php">
              <td class="table_center">
                <input type="text" name="update_stock" placeholder="<?php print $value['stock']; ?>">個
                <input type="submit" value=" 変更">
                <input type="hidden" name="data" value="update_stock">
                <input type="hidden" name="id" value="<?php print $value['id']; ?>">     
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              </td>
              </form>
              <form method="post" enctype="multipart/form-data" action="./manage_items_update_comment.php">
              <td class="table_center">
                <textarea name="update_comment" placeholder="<?php print $value['comment']; ?>"></textarea>
                <input type="submit" value=" 変更">
                <input type="hidden" name="data" value="update_comment">
                <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              </td>
              </form>
              <form method="post" enctype="multipart/form-data" action="./manage_items_update_status.php">
              <td class="table_center">
                <?php if($value['status'] === 1) { ?>  
                <input type="submit" name="update_status" value="公開 → 非公開">
                <input type="hidden" name="data" value="update_status">
                <input type="hidden" name="status" value="private">
                <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
                <?php } else { ?>
                  <input type="submit" name="update_status" value="非公開 → 公開">
                  <input type="hidden" name="data" value="update_status">
                  <input type="hidden" name="status" value="public">
                  <input type="hidden" name="id" value="<?php print $value['id']; ?>">
                  <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                  <input type="hidden" name="page" value="<?php print $page; ?>">
                <?php } ?>
              </td>
              </form>
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_items_delete_items.php">
　　　　      <td class="table_center"><?php print round($value['review_point'], 2); ?>
              <td><input type="submit" value="削除"></td>
                <input type="hidden" name="data" value="delete_items">
                <input type="hidden" name="item_id" value="<?php print $value['id']; ?> ">
                <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                <input type="hidden" name="page" value="<?php print $page; ?>">
              </td>
              </form>
            </tr>
            <?php } ?>
          </table>
          <table class="page">
            <tr>
              <td class="page">
              <?php if($prev_page === 0) { ?>
                <<前のページへ
              <?php } else { ?>
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_items.php">
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
　　　　      <form method="post" enctype="multipart/form-data" action="./manage_items.php">
                <input type="submit" value="次のページへ>>">
                <input type="hidden" name="page" value="<?php print $page + 1; ?>">
              </form>                 
              <?php } ?>
              </td>
            </tr>
          </table>
        </div>
        
      </div>
    </div>
  </body>
</html>