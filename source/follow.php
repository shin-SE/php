<?php

if(isset($_POST['follow'])){
     if(isset($_SESSION['id'])){
         $thisid= $_SESSION['id'];
         $followid = $_POST['follow'];
         

         $result = mysqli_query($conn,"select * from follow where follow_id= '$followid' AND follower_id= '$thisid' ");
         
         if(!$result){
                 echo '<br>エラー：現在threadnoテーブルアクセス出来ません<br>';
         }else{
                 $row =mysqli_num_rows($result);
                 
                 $follow_sql=$conn->query("select * from follow where follow_id= '$followid' AND follower_id= '$thisid'");
                 if(!$follow_sql){
                     $count=0;
                     }else{
                     $count=$follow_sql->num_rows;
                  }
                 if($count==0){              // follow+1
                 
                                 //update trd table
                       $stmt= $conn->prepare("insert into follow (follow_id,follower_id) values (?,?)");
                       $stmt->bind_param('ii',$followid,$thisid);
                       $stmt->execute();

                       unset ($_POST['follow']);
                 
                }else if($count!=0){                        //follow -1

                                  //update trd table
                       $stmt= $conn->prepare("delete from follow where follow_id=? AND follower_id=?");
                       $stmt->bind_param('ii',$followid,$thisid);
                       $stmt->execute();

                       unset ($_POST['follow']);
                 
               }
          }
     }else{
          $alert="<script type='text/javascript'>alert('You must login first.');</script>";
          echo $alert;
          
     }
   }
?>
