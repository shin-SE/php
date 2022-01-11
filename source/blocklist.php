<?php
   echo "<ul>\n";
    $stmt_block_id = $db->prepare("
       SELECT blockoppoment_id FROM block WHERE user_id=:id
       ");
    $stmt_block_id->execute();
    $row_block_id = $stmt_block_id->fetch();
    do {
        $stmt_block_name = $db->prepare("
            SELECT user_name FROM user_kihon WHERE user_id=::block_id
          ");
        // ƒnKƒ‰ƒ[ƒ^‚ðŠ„‚è“–‚Ä
        $stmt_block_name->bindParam(':block_id',$row_block_id , PDO::PARAM_STR);
        $stmt_block_name->execute();
        $row_block_name = $stmt_block_name->fetch();
        echo "<li>".$row_block_name."</li>";
    } while ($row_block_id = $stmt_block_id->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
    echo "<\ul>\n";
?>
