<?php

if(isset($_POST['mute'])){

     if(isset($_SESSION['id'])){
         $id= $_SESSION['id'];
         $muteid = $_POST['mute'];
                
                 $result_muting=$conn->query("select user_id from mute where thread_id='$newname' AND colume_id='$muteid' and user_id='$id'");
                 $row_cnt_mute = $result_muting->num_rows;
             
                 if($row_cnt_mute==0){         // mute
                      
                       $stmt= $conn->prepare("insert into mute (thread_id,colume_id,user_id) values (?,?,?)");
                       $stmt->bind_param('iii',$newname,$muteid,$id);
                       $stmt->execute();

                       
                       
                 
                }else{                        //quit mute

                       $stmt= $conn->prepare("delete from mute where (thread_id=? AND colume_id=? )AND user_id=?");
                       $stmt->bind_param('iis',$newname,$muteid,$id);
                       $stmt->execute();

                 
               }
          }else if(!isset($_SESSION['id'])){
              $alert="<script type='text/javascript'>alert('You must login first.mute.');</script>";
               echo $alert;
          
     }

unset($_POST['mute']);

     }

   
?>
