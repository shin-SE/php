<?php
if (!empty($res_data)){
      while($row = mysqli_fetch_array($res_data)){
            ?>
             <div class="that">
            <img src="../profile.png" class="circle">
                  <div class="it">
                        <!--タイトル-->
                        
                        ユーザー名 &nbsp;:<?php if ($row['anonymous'] == "f") {
                  	        echo ($row['user_name']);
                             } else {
                  	        echo '匿名希望さん';
                             }?><br>
                        作成日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?=($row['posttime'])?><br>
                        <!--作成日-->
                        コンテンツ&nbsp;&nbsp;:<?php
                        if(isset($_SESSION['id'])){
                                 $colume= $row['colume_id'];
                                 $id=$_SESSION['id'];
                                 $result_mute=$conn->query("select * from mute where thread_id='$newname' AND colume_id='$colume' and user_id='$id'");
                                 $row_cnt = $result_mute->num_rows;
                                 if($row_cnt==1){
                                    echo 'ミュート中';
                                 }else{
                                    echo $row['content'];
                                 }
                                 }else{
                                 echo $row['content'];
                                 }
                                 $flag_mute=false;
                                 ?>
                  </div>
                  <div class="itt">
                        <div class="inner_itt">
                        <form  method="post">
                             <?php  
                                 $colume_id=$row['colume_id'];
                                 $result_like = mysqli_query($conn,"select like_cnt from threadno".$newname." where colume_id= '$colume_id' ");
                                 $row_like = mysqli_fetch_assoc($result_like);
                                 
                                 
                             ?>
                                     <button  type="submit" name="like" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_like" >
                                           <i class="fas fa-thumbs-up"></i>いいね！(<?php echo $row_like['like_cnt'] ?>)
                                     </button>
                                     </form>
                               <form  method="post">      
                                     <button  type="submit" name="mute" value="<?php echo $row['colume_id'] ?>" class="btn_itt btn_mute">
                                           <i class="fas fa-comment-slash"></i>コメント非表示
                                     </button>
                                </form>
                                 <form  method="post">  
                                     <button type="submit" name="block" value="<?php echo $row['user_id'] ?>" class="btn_itt btn_block">
                                           <i class="fas fa-user-slash"></i>投稿者ブロック
                                     </button>
                                </form>
                                <form  method="post">         
                                     <button  type="submit" name="follow" value="<?php echo $row['colume_id'] ?>"  class="btn_itt btn_follow">
                                           <i class="fas fa-plus"></i>投稿者フォロー
                                     </button>
                              </form>


                        </div>
                  </div>
                  <hr class="pat">
            </div>
      <?php
      }
}else{
      echo "コメント存在しない。";
}
      mysqli_close($conn);
?>
