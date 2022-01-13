<?php

if(isset($_POST['like'])){
     if(isset($_SESSION['id'])){
         $id= $_SESSION['id'];
         $likeid = $_POST['like'];
         echo $_POST['like'];
         $title= __FILE__;
         $table_id=substr($title,-11,7);

         $result = mysqli_query($conn,"select like_cnt from threadno".$newname." where colume_id= '$likeid' ");
         $row = mysqli_fetch_assoc($result);
         echo $row['like_cnt'];
         if(!$result){
                 
                  '<br>エラー：現在threadnoテーブルアクセス出来ません<br>';
         }else{
                 echo $row['like_cnt'];
                 $ip_sql=$conn->query("select user_id from like_ip where thread_id='$newname' AND colume_id='$likeid' AND user_id='$id'");
                 if(!$ip_sql){
                     $count=0;
                     }else{
                     $count=$ip_sql->num_rows;
                  }
                 echo "<br>count:".$count;
                 if($count==0){              // like+1
                 
                                 //update trd table
                       $like_count=$row['like_cnt']+1;
                       $stmt = $conn->prepare("UPDATE threadno".$newname." SET like_cnt=? where colume_id=?");
                       $stmt->bind_param('ii',$like_count,$likeid);
                       $stmt->execute();
                       
                       
                                  //insert into like_ip table
                       $stmt= $conn->prepare("insert into like_ip (thread_id,colume_id,user_id) values (?,?,?)");
                       $stmt->bind_param('iii',$newname,$likeid,$id);
                       $stmt->execute();

                       unset ($_POST['like']);
                 
                }else if($count!=0){                        //like -1

                                  //update trd table
                       $like_count=$row['like_cnt']-1;
                       
                       $stmt = $conn->prepare("UPDATE threadno".$newname." SET like_cnt=? where colume_id=?");
                       $stmt->bind_param('ii',$like_count,$likeid);
                       $stmt->execute();
                       
                       
                                   //delete threadno table
                       $stmt= $conn->prepare("delete from like_ip where (thread_id=? AND colume_id=? )AND user_id=?");
                       $stmt->bind_param('iis',$newname,$likeid,$id);
                       $stmt->execute();

                       unset ($_POST['like']);
                 
               }
          }
     }else{
          $alert="<script type='text/javascript'>alert('You must login first.like.');</script>";
          echo $alert;
          
     }
   }
?>
