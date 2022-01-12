<?php

if(isset($_POST['mute'])){
     if(isset($_SESSION['id'])){
         $id= $_SESSION['id'];
         $muteid = $_POST['mute'];
                
                 $stmt=mysqli_query($conn,"select user_id from mute where thread_id='$newname' AND colume_id='$muteid' and user_id='$id'");
                 $count=mysqli_num_rows($stmt);
                 

                 if($count==0){              // mute
                      
                       $stmt= $conn->prepare("insert into mute (thread_id,colume_id,user_id) values (?,?,?)");
                       $stmt->bind_param('iis',$newname,$muteid,$id);
                       $stmt->execute();

                       unset ($_POST['mute']);
                 
                }else if($count==1){                        //quit mute

                       $stmt= $conn->prepare("delete from mute where (thread_id=? AND colume_id=? )AND user_id=?");
                       $stmt->bind_param('iis',$newname,$muteid,$id);
                       $stmt->execute();

                       unset ($_POST['mute']);
                 
               }
          }
     }else{
          $alert="<script type='text/javascript'>alert('You must login first.');</script>";
          echo $alert;
          
     }
   }
?>