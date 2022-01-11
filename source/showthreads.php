<?php
if (!empty($res_data)){
      while($row = mysqli_fetch_array($res_data)){
            ?>
            <div class="lll">
                  <div class="llo"></div>
                  <div class="loo">
                        <p>
                              タイトル&nbsp;&nbsp;&nbsp;:<a  class="ioo_link" href="threads/<?=($row['thread_id'])?>.php"><?=($row['thread_name'])?></a><br>
                              作成日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?=($row['posttime'])?><br>
                              ユーザー名:<?=($row['user_name'])?><br>
                              最終投稿日:<?=($row['last_post_time'])?>
                        </p>
                  </div>
            </div>
      <?php
            }
}else{
      echo "スレッド存在しない。";
}
      mysqli_close($conn);
?>
