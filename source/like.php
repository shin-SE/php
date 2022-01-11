<?php
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_POST['like'])){
    $likeid = $_POST['like'];
    
    $title= __FILE__;
	$table_id=substr($title,-11,7);

    $result = mysqli_query($conn,"select like_cnt from threadno".$newname." where colume_id= '$likeid' ");
    $row = mysqli_fetch_assoc($result);
    echo $row['like_cnt'];
  
     if(!$row['like_cnt']){
            echo '<br>エラー：現在threadnoテーブルアクセス出来ません<br>';
     }else{
         
            $ip_sql=mysqli_query($conn,"select ip from like_ip where thread_id='$table_id' AND colume_id='$likeid' and ip='$ip'");
            $count=mysqli_num_rows($ip_sql);
            
            
          if($count==0){              // like+1
            
                            //update trd table
                  $like_count=$row['like_cnt']+1;
                  $stmt = $mysqli->prepare( "update threadno".$table_id." set like_cnt=? where colume_id=?'");
                  $stmt->bind_param('ii',$like_count,$likeid);
                  $stmt->execute();
                  
                  
                             //insert into threadno table
                  $stmt= $mysqli->prepare("insert into like_ip (thread_id,colume_id,ip) values (?,?,?)");
                  $stmt->bind_param('iis','$table_id','$likeid','$ip');
                  $stmt->execute();

                  unset ($_POST['like']);
            
           }else if($count==1){                        //like -1

                             //update trd table
                  $like_count=$row['like_cnt']-1;
                  
                  $stmt = $conn->prepare( "update threadno".$newname." set like_cnt=? where colume_id=?'");
                  $stmt->bind_param('ii',$like_count,$likeid);
                  $stmt->execute();
                  
                  
                              //delete threadno table
                  $stmt= $mysqli->prepare("delete from like_ip where (thread_id=? AND colume_id=? )AND ip=?");
                  $stmt->bind_param('iis','$table_id','$likeid','$ip');
                  $stmt->execute();

                  unset ($_POST['like']);
            
          }
     }
     }
?>