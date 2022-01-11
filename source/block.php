<?php
if(isset($_POST['block'];)){
if(isset($SESSION['name'])){
    $thisid=$_SESSION['id'];
    $blockname=$POST['block'];
    
    
    //get block_id 
    $stmt_getId=$mysqli->prepare('SELECT user_id FROM user_kihon  WHERE user_name=:block_name');
     $stmtstmt_getId->bind_param(':block_name',$blockname , PDO::PARAM_STR);
     
     
   //get block_id -SQL実行
     $stmt_getId->execute();
     $block_id = $stmt_getId->get_result();
     
     
    //insert table block
    $stmt_block=$mysqli->prepare('INSERT INTO block(user_id,blockoppoment_id)values(?,?)');
     $stm_blockt->bind_param('ii',$thisid,$block_id);
    $stmt_block->execute();
    
    $result = $stmt_block->get_result();
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