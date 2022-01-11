<?php
if(isset($_POST['follow'];)){
if(isset($SESSION['name'])){
     
    $thisid=$_SESSION['id'];
    $followname=$POST['follow'];
      
    //get follow_id 
    $stmt_getId=$mysqli->prepare('SELECT user_id FROM user_kihon  WHERE user_name=:follow_name');
     $stmtstmt_getId->bind_param(':follow_name',$follow_name , PDO::PARAM_STR);
     
     
   //get follow_id -SQL実行
     $stmt_getId->execute();
     $follow_id = $stmt_getId->get_result();
     
   //insert  -SQL実行
    $stmt=$mysqli->prepare('INSERT INTO follow(follow_id,follower_id)values(?,?)');
    
    $stmt->bind_param('ii',$followid,$thisid);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result==false){
    printf("Error: %s.\n", mysqli_stmt_error($stmt));
    /* ステートメントを閉じます */
    $stmt->close();
    }
}else{
    $alert = "<script type='text/javascript'>alert('ログインしてください。');</script>";
    echo $alert;
}

}

?>