<?php
if (!empty($res_data)){
      while($row = mysqli_fetch_array($res_data)){
            ?>
            
            <div class="ill">
            <img src="../profile.png" class="circle">
                  <div class="itt">
                        <!--タイトル-->
                        
                        ユーザー名 &nbsp;:<?php if ($row['anonymous'] == "f") {
                              echo ($row['user_name']);
                        } else {
                              echo '匿名希望さん';
                        }?><br>
                        作成日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?=($row['posttime'])?><br>
                        <!--作成日-->
                        コンテンツ&nbsp;&nbsp;:<?=($row['content'])?>
                  </div>
                  <div class="itt_1">
                        <div class="inner_itt">
                        <form  method="post">
                              <button  type="submit" name="like" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_like">
                                    <i class="fas fa-thumbs-up"></i>投稿いいね
                              </button>

                              <button  type="submit" name="mute" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_mute">
                                    <i class="fas fa-comment-slash"></i>コメント非表示
                              </button>

                              <button type="submit" name="block" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_block">
                                    <i class="fas fa-user-slash"></i>投稿者ブロック
                              </button>

                              <button  type="submit" name="follow" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_follow">
                                    <i class="fas fa-plus"></i>投稿者フォロー
                              </button>
                        </form>
                        </div>
                  </div>
                  <hr class="pill">
            </div>
      <?php
      }
}else{
      echo "コメント存在しない。";
}
      mysqli_close($conn);
?>
