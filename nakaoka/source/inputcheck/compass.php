<?php
function comp_pass($pwd1,$pwd2){
    
    if($pwd1!=$pwd2){
        return '<span color="#FF0000">パスワード一致しない、もう一度確認お願いします。</span>';
    }else{
        $is_comp=true;
        return '&nbsp;';
    }
}

?>
