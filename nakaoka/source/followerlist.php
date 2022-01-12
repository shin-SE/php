<?php
   echo "<ul>\n";
    $stmt_follower_id = $db->prepare("
       SELECT follower_id FROM follow WHERE follow_id=:id
       ");
    $stmt_follower_id->execute();
    $row_follower_id = $stmt_follower_id->fetch();
    do {
        $stmt_follower_name = $db->prepare("
            SELECT user_name FROM user_kihon WHERE user_id=::follower_id
          ");
        // �n�K�����[�^�����蓖��
        $stmt_follower_name->bindParam(':follower_id',$row_follower_id , PDO::PARAM_STR);
        $stmt_follower_name->execute();
        $row_follower_name = $stmt_follower_name->fetch();
        echo "<li>".$row_follower_name."</li>";
    } while ($row_follower_id = $stmt_follower_id->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
    echo "<\ul>\n";
?>