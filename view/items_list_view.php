<!-- items_list_view.php -->
<!-- 商品一覧画面 -->
<!-- include/gotouchi/view/items_list_view.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include_once VIEW_PATH . 'templates/head.php'; ?>
    <title>商品一覧画面 - Gotouchi</title>
    <link rel="stylesheet" href="<?php print CSS_DIR . 'items_list.css'; ?>">
  </head>
    <body>
      <div class="container">
    　<?php include_once VIEW_PATH . 'header_user_view.php'; ?>
        <div class="container_main">
    <?php include_once VIEW_PATH . 'templates/messages.php'; ?>
          <div class="container_main_top">
            <div class="title">本日のオススメグルメ</div>
            <div class="item_cell">
            <?php $lp1 = 0; ?>
              <ul>
              <?php foreach($datas as $value) { ?>
                <li class="item_detail">
                  <div class="t_row1"><span class="t_space1">商品名</span>：<?php print $value['name']; ?></div>
                  <div class="t_row2"><span class="t_space2">産地</span>：<?php print $value['area_name']; ?></div>                
                  <div class="t_row3">カテゴリ：<?php print $value['type_name']; ?></div>
                  <div class="t_row4">
                  <?php if($value['review_point'] === '0') { ?>
                    <div class="center empty">★-/5<span class="t_space4"></span></div>
                    <div class="center empty"></div> 
                  <?php } else { ?>
                    <div>★<?php print round($value['review_point'], 2); ?>/5<span class="t_space4"></span></div>
                    <form method="post" enctype="multipart/form-data" action="./review_list.php">
                      <div>
                        <input type="submit" value="レビュー">
                        <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                      </div>
                    </form>
                  <?php } ?>
                  </div> 
                  <div class="t_row5 center">
                    <form method="get" enctype="multipart/form-data" action="./items_detail.php">
                      <a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><img src="<?php print './image/' .$value['img']; ?>"></a>
                      <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">
                    </form>                   
                  </div>
                  <div class="t_row6">
                    <div><?php print $value['price']; ?>円<span class="t_space6"></div>
                    <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">                
                      <div class="center">
                      <?php if($value['stock'] > 0) { ?>
                        <div id="cart"><input type="submit" value="カートに入れる"></div>
                      <?php } else { ?>
                        <div id="cart">在庫切れ</div>                
                      <?php } ?>
                        <input type="hidden" name="data" value="update_cart">
                        <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                        <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">  
                      </div>
                    </form>
                  </div>
                </li>
                <?php $lp1++; ?>
              <?php } ?>
              <?php while($lp1 % 3 !== 0) { ?>
                <li class="empty"></li>
                <?php $lp1++; ?>
              <?php } ?>
              </ul>
            </div>
          </div>
          <div class="container_main_middle">
            <div class="title">検索</div>
            <div class="container_main_search">
              <form method="post" enctype="multipart/form-data" action="./items_list_search.php">
                <div class="m_row1">      
                  <div class="m_col1">
                    カテゴリ：
                    <select name="check_type">
                      <option value="default">選択</option>
                      <?php foreach($data2 as $value) { ?>
                        <option value="<?php print $value['id']; ?>"><?php print $value['type_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="m_col2">
                    <span class="m_space1_1"></span>産地：
                      <select name="check_area">
                        <option value="default">選択</option>
                        <?php foreach($data3 as $value) { ?>
                          <option value="<?php print $value['id']; ?>"><?php print $value['area_name']; ?></option>
                        <?php } ?>
                      </select>
                    <span class="m_space1_2"></span>
                  </div>
                  <div class="m_col3">
                    キーワード：
                    <input id="text_keyword" type="text" name="keyword" placeholder="例：大吟醸" size="20">
                  </div>
                </div>
                <div class="m_row2">
                  <div class="m_col1">
                    並べ替え：
                    <select id="check_sort" name="check_sort">
                      <option value="default">選択</option>
                      <option value="rating_high">評価が高い順</option>
                      <option value="price_low">値段が安い順</option>
                      <option value="price_high">値段が高い順</option>
                      <option value="update_new">登録が新しい順</option>
                    </select>          
                  </div>
                  <div class="m_col2">
                    <span class="m_space2_1"></span>
                    <input type="submit" value="検索">
                    <input type="hidden" name="search_items" value="search_items">
                    <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>"> 
                    <span class="m_space2_2"></span>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="container_main_bottom">
          <?php if(isset($data4)) { ?>
            <div class="title">検索結果(全<?php print $count[0][0]; ?>件中<?php print $from_page + 1; ?>-<?php print $to_page; ?>件を表示)</div>
            <?php if($num_search === 0) { ?>
              <div class="err_msg"><?php print $err_search; ?></div>
            <?php } else { ?>
              <div class="item_cell">
              <?php $lp1 = 0; ?>
                <ul>
                <?php foreach($data4 as $value) { ?>
                  <li class="item_detail">
                    <div class="t_row1"><span class="t_space1">商品名</span>：<?php print $value['name']; ?></div>
                    <div class="t_row2"><span class="t_space2">産地</span>：<?php print $value['area_name']; ?></div>                
                    <div class="t_row3">カテゴリ：<?php print $value['type_name']; ?></div>
                    <div class="t_row4">
                      <?php if($value['review_point'] === '0') { ?>
                        <div class="center empty">★-/5<span class="t_space4"></span></div>
                        <div class="center empty"></div> 
                      <?php } else { ?>
                        <div>★<?php print round($value['review_point'], 2); ?>/5<span class="t_space4"></span></div>
                        <form method="post" enctype="multipart/form-data" action="./review_list.php">
                          <div>
                            <input type="submit" value="レビュー">
                            <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">  
                          </div>
                        </form>
                      <?php } ?>
                    </div> 
                    <div class="t_row5 center">
                      <form method="get" enctype="multipart/form-data" action="./items_detail.php">
                        <a href="./items_detail.php?item_id=<?php print $value['id']; ?>"><img src="<?php print './image/' .$value['img']; ?>"></a>
                        <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">
                      </form>                   
                    </div>
                    <div class="t_row6">
                      <div><?php print $value['price']; ?>円<span class="t_space6"></div>
                      <form method="post" enctype="multipart/form-data" action="./cart_detail_change_cart.php">                
                        <div class="center">
                        <?php if($value['stock'] > 0) { ?>
                          <div id="cart"><input type="submit" value="カートに入れる"></div>
                        <?php } else { ?>
                          <div id="cart">在庫切れ</div>                
                        <?php } ?>
                          <input type="hidden" name="data" value="update_cart">
                          <input type="hidden" name="item_id" value="<?php print $value['id']; ?>">
                          <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                        </div>
                      </form>
                    </div>
                  </li>
                  <?php $lp1++; ?>
                  <?php if($lp1 % 3 === 0) { ?>
                    </ul><ul>
                  <?php } ?>
                <?php } ?>
                <?php while($lp1 % 3 !== 0) { ?>
                  <li class="empty"></li>
                  <?php $lp1++; ?>
                <?php } ?>
                </ul>
              </div>
            <?php } ?>
          <table class="page">
            <tr>
              <td class="page">
              <?php if($prev_page === 0) { ?>
                <<前のページへ
              <?php } else { ?>
　　　　        <form method="post" enctype="multipart/form-data" action="./manage_buy.php">
                  <input type="submit" value="<<前のページへ">
                  <input type="hidden" name="search_items" value="search_items">
                  <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
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
                  <input type="hidden" name="search_items" value="search_items">
                  <input type="hidden" name="csrf_token" value="<?php print $csrf_token; ?>">
                  <input type="hidden" name="page" value="<?php print $page + 1; ?>">
                </form>                 
              <?php } ?>
              </td>
            </tr>
          </table>
          <?php } ?>
        </div>
      </div>
    <?php include_once VIEW_PATH . 'templates/footer_view.php'; ?>
    </div>
  </body>
</html>