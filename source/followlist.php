<?php
   echo "<ul>\n";
    $stmt_follow_id = $db->prepare("
       SELECT follow_id FROM follow WHERE follower_id=:id
       ");
    $stmt_follow_id->execute();
    $row_follow_id = $stmt_follow_id->fetch();
    do {
        $stmt_follow_name = $db->prepare("
            SELECT user_name FROM user_kihon WHERE user_id=::follow_id
          ");
        // ƒnKƒ‰ƒ[ƒ^‚ðŠ„‚è“–‚Ä
        $stmt_follow_name->bindParam(':follow_id',$row_follow_id , PDO::PARAM_STR);
        $stmt_follow_name->execute();
        $row_follow_name = $stmt_follow_name->fetch();
        echo "<li>".$row_follow_name."</li>";
    } while ($row_follow_id = $stmt_follow_id->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
    echo "<\ul>\n";
?>
