<?php

if(isset($_POST['block'])){
     if(isset($_SESSION['id'])){
         $thisid= $_SESSION['id'];
         $blockid = $_POST['block'];
         

         $result = mysqli_query($conn,"select * from block where user_id= '$thisid' AND blockoppoment_id= '$blockid' ");
         
         if(!$result){
                 echo '<br>エラー：現在threadnoテーブルアクセス出来ません<br>';
         }else{
                 $row =mysqli_num_rows($result);
                 
                 $block_sql=$conn->query("select * from block where user_id= '$thisid' AND blockoppoment_id= '$blockid'");
                 if(!$block_sql){
                     $count=0;
                     }else{
                     $count=$block_sql->num_rows;
                  }
                 if($count==0){              // block+1
                 
                                 //update trd table
                       $stmt= $conn->prepare("insert into block (blockoppoment_id,user_id) values (?,?)");
                       $stmt->bind_param('ii',$blockid,$thisid);
                       $stmt->execute();

                       unset ($_POST['block']);
                 
                }else if($count!=0){                        //block -1

                                  //update trd table
                       $stmt= $conn->prepare("delete from block where blockoppoment_id=? AND user_id=?");
                       $stmt->bind_param('ii',$blockid,$thisid);
                       $stmt->execute();

                       unset ($_POST['block']);
                 
               }
          }
     }else{
          $alert="<script type='text/javascript'>alert('You must login first.');</script>";
          echo $alert;
          
     }
   }
?>
